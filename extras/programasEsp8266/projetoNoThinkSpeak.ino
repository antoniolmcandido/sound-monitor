#include <ESP8266WiFi.h>

#define SSID_REDE     "IFCE CAUCAIA"
#define SENHA_REDE    "GDWKB97CVXQBJJ4"
#define INTERVALO_ENVIO_THINGSPEAK  20000

//constantes e variáveis globais
//canal: https://thingspeak.com/channels/318623
char enderecoAPIThingSpeak[] = "api.thingspeak.com";
String chaveEscritaThingSpeak = "IILLGJFRY94GPDS9";
long lastConnectionTime; 
WiFiClient client;

//variaveis para o calculo do ruido
const int sampleWindow = 50; // janela de exemplo com largura de 50 milisegundos (50 mS = 20Hz)
unsigned int sample;
float ruido;

//prototipos
void enviaInformacoesThingspeak(String StringDados);
void fazConexaoWiFi(void);
float calculaRuido(void);

//rede
byte mac[6];

//Função: calculo o nivel de ruido obtido pelo MAX4466
float calculaRuido(void) {
  unsigned long startMillis= millis();  // inicio da janela de exemplo em milisegundos
  unsigned int peakToPeak = 0;   // amplitude pico-a-pico
  unsigned int signalMax = 0; // sinal maximo
  unsigned int signalMin = 1024; //sinal minimo
 
  // coletando dados em 50 mS
  while (millis() - startMillis < sampleWindow) {
    sample = analogRead(0);
    if (sample < 1024) {  // controle de leituras falsas
      if (sample > signalMax) {
        signalMax = sample;  // guardando apenas os niveis maximos
      }
      else if (sample < signalMin){
        signalMin = sample;  // guardando apenas os niveis minimos
      }
    }
  }
  
  peakToPeak = signalMax - signalMin;  // max - min = peak-peak amplitude
  double volts = (peakToPeak * 3.3) / 1024;  // convertendo para volts
  
  if (volts > 0.00000) {
    ruido = 30.0;
  }
  if (volts > 0.00500) {
    ruido = 35.0;
  }
  if (volts > 0.00800) {
    ruido = 36.0;
  }
  if (volts > 0.01100) {
    ruido = 37.0;
  }
  if (volts > 0.01400) {
    ruido = 38.0;
  }
  if (volts > 0.01700) {
    ruido = 39.0;
  }
  if (volts > 0.02000) {
    ruido = 40.0;
  }
  if (volts > 0.02300) {
    ruido = 41.0;
  }
  if (volts > 0.02600) {
    ruido = 42.0;
  }
  if (volts > 0.02900) {
    ruido = 43.0;
  }
  if (volts > 0.03100) {
    ruido = 43.0;
  }
  if (volts > 0.03500) {
    ruido = 45.0;
  }
  if (volts > 0.05000) {
    ruido = 50.0;
  }
  if (volts > 0.06500) {
    ruido = 55.0;
  }
  if (volts > 0.08000) {
    ruido = 60.0;
  }
  if (volts > 0.10000) {
    ruido = 65.0;
  }
  if (volts > 0.20000) {
    ruido = 70.0;
  }
  if (volts > 0.40000) {
    ruido = 75.0;
  }
  if (volts > 0.70000) {
    ruido = 80.0;
  }
  if (volts > 1.00000) {
    ruido = 85.0;
  }

  return ruido;      
}

void acionaSirene(float ruido) {  
  if (ruido >= 60.0) {
    digitalWrite(16, HIGH); 
    delay(1000);
    digitalWrite(16, LOW);    
  }  
}

//Função: envia informações ao ThingSpeak
void enviaInformacoesThingspeak(String stringDados) {
  if (client.connect(enderecoAPIThingSpeak, 80)) {         
    //faz a requisição HTTP ao ThingSpeak
    client.print("POST /update HTTP/1.1\n");
    client.print("Host: api.thingspeak.com\n");
    client.print("Connection: close\n");
    client.print("X-THINGSPEAKAPIKEY: "+chaveEscritaThingSpeak+"\n");
    client.print("Content-Type: application/x-www-form-urlencoded\n");
    client.print("Content-Length: ");
    client.print(stringDados.length());
    client.print("\n\n");
    client.print(stringDados);
  
    lastConnectionTime = millis();
    Serial.println("- Informações enviadas ao ThingSpeak!");
  }   
}

//Função: faz a conexão WiFI
void fazConexaoWiFi(void) {
  client.stop();
  Serial.println("Conectando-se à rede WiFi...");
  Serial.println();  
  delay(1000);
  WiFi.begin(SSID_REDE, SENHA_REDE);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connectado com sucesso!");  
  Serial.print("IP obtido: ");
  Serial.println(WiFi.localIP());
  WiFi.macAddress(mac);
  Serial.print("MAC: ");
  Serial.print(mac[0],HEX);
  Serial.print(":");
  Serial.print(mac[1],HEX);
  Serial.print(":");
  Serial.print(mac[2],HEX);
  Serial.print(":");
  Serial.print(mac[3],HEX);
  Serial.print(":");
  Serial.print(mac[4],HEX);
  Serial.print(":");
  Serial.println(mac[5],HEX);
  delay(1000);
}

void setup() {  
  Serial.begin(115200);
  pinMode(16, OUTPUT);
  lastConnectionTime = 0; 
  fazConexaoWiFi();    
}

//loop principal
void loop() {
  float ruidoObtido;    
  char fieldRuido[11];
    
  //Força desconexão ao ThingSpeak (se ainda estiver desconectado)
  if (client.connected()) {
    client.stop();
    Serial.println("- Desconectado do ThingSpeak");
    Serial.println();
  }

  ruidoObtido = calculaRuido();
  Serial.println(ruidoObtido);
  acionaSirene(ruidoObtido);
        
  //verifica se está conectado no WiFi e se é o momento de enviar dados ao ThingSpeak
  if(!client.connected() && (millis() - lastConnectionTime > INTERVALO_ENVIO_THINGSPEAK)) {
    sprintf(fieldRuido,"field1=%d",(int)ruidoObtido);
    enviaInformacoesThingspeak(fieldRuido);
  }
  delay(1000);
}
