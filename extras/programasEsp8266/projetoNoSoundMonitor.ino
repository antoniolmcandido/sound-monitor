#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

#define SSID_REDE     "IFCE CAUCAIA"
#define SENHA_REDE    "GDWKB97CVXQBJJ4"
//#define SSID_REDE     "Virus"
//#define SENHA_REDE    "#Leocandido"
#define INTERVALO_ENVIO_SOUNDMONITOR  15000

// configuracao do Sound Monitor
const String host = "sm.tk";
const int port = 80;
const String api_key = "4a09c2c0-a789-4a7e-a6e4-209f625a308d";
const String monitor_key = "8d0691f4-1b34-9053-a138-dd99ac507af5";
byte mac[6];
long lastConnectionTime; 
WiFiClient client;
HTTPClient http;
DynamicJsonBuffer jsonBuffer;

//variaveis para o calculo do ruido
const int sampleWindow = 50; // janela de exemplo com largura de 50 milisegundos (50 mS = 20Hz)
unsigned int sample;
float ruido;
float ruidoAcumulado;
int contador;
int nivelRuidoPermitido = 120;

//token para autorizar postar os valores no Sound Monitor
String token = "";
int remaining = -1;

//Função que calcula o ruido obtido do MAX4466
void calculaRuido(void) {
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
}

void acionaSirene() {
  digitalWrite(13, HIGH); 
  delay(1000);
  digitalWrite(13, LOW);  
}

bool auth() {
  http.begin(host, port, "/api/authenticate");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  String payload = "api_key=" + api_key + "&monitor_key=" + monitor_key;
  Serial.print("payload: ");
  Serial.println(payload);

  const char* headerNames[] = { "X-RateLimit-Remaining" };
  http.collectHeaders(headerNames, sizeof(headerNames)/sizeof(headerNames[0]));

  int httpCode = http.POST(payload);
  String response = http.getString();

  if (httpCode == HTTP_CODE_OK) {
    JsonObject& root = jsonBuffer.parseObject(response);
    token = root["token"].as<String>();
    Serial.println("- Pronto para enviar os dados -");

  if (http.hasHeader("X-RateLimit-Remaining")) {
    remaining = http.header("X-RateLimit-Remaining").toInt();
  } else {
      Serial.println("Header: X-RateLimit-Remaining not found");
    }
  } else {
      token = "";
  }
  
  http.end();
  return httpCode == HTTP_CODE_OK;
}

//Função: envia informações ao Sound Monitor
bool send(float value) {
  http.begin(host, port, "/api/send");
  http.addHeader("Content-Type", "application/json");
  http.addHeader("Authorization", "Bearer " + token);
  String payload;  
  JsonObject& root = jsonBuffer.createObject();
  JsonObject& data = root.createNestedObject("data");
  data["value"] = value;
  root.printTo(payload);
  int httpCode = http.POST(payload);
  String response = http.getString();

  Serial.print("Codigo HTTP: ");
  Serial.println(httpCode);
  Serial.print("Resposta HTTP: ");
  Serial.println(response);
    
  if (httpCode == 200){
    Serial.println("- Informações enviadas ao Sound Monitor! -");    
    JsonObject& root2 = jsonBuffer.parseObject(response);
    nivelRuidoPermitido = root2["nivelPermitido"];  
  }
    
  if (httpCode == 401){
    Serial.println("Token atualizado!");
    nivelRuidoPermitido = 120;
    auth();      
  }

  if ((httpCode == -1) || (httpCode == -2) || (httpCode == -11) || (httpCode == 400)){
    Serial.println("ERRO! Reiniciando o Sistema!");
    nivelRuidoPermitido = 120;
    reiniciarSistema();      
  }
    
  lastConnectionTime = millis();    
  http.end();
  return httpCode == HTTP_CODE_OK;
}

//Função: faz a conexão WiFI
void fazConexaoWiFi(void) {
  client.stop();
  Serial.println("Conectando-se à rede WiFi...");
  Serial.println(SSID_REDE);
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

void reiniciarSistema() {
  pinMode(0,OUTPUT);
  digitalWrite(0,HIGH);
  pinMode(2,OUTPUT);
  digitalWrite(2,HIGH);
  ESP.restart();
} 

void setup() {  
  Serial.begin(115200);
  pinMode(13, OUTPUT);
  lastConnectionTime = 0; 
  fazConexaoWiFi();
  auth();  
}

//loop principal
void loop() {      
  if (client.connected()) {
    client.stop();
    Serial.println("- Desconectado do Sound Monitor");
    Serial.println();
  }

  calculaRuido();
  ruidoAcumulado = ruidoAcumulado + ruido;
  contador++;
  
  if(ruido >= nivelRuidoPermitido){
    acionaSirene();
  }
   
  Serial.println(ruido);
        
  //verifica se está conectado no WiFi e se é o momento de enviar dados ao Sound Monitor
  if(!client.connected() && (millis() - lastConnectionTime > INTERVALO_ENVIO_SOUNDMONITOR)) {    
    send((int)ruidoAcumulado / contador); //envia a media dos valores obtidos
    ruidoAcumulado = 0;
    contador = 0;
  }
  delay(1000);
}
