<div class="row">
    <div class="col-md-12">
        <h4>Defina o <code>limite</code> adequado em decibéis para o ambiente</h4><hr>
		
		<script type="text/javascript">
		function alterarNivel() {
			$nivel = document.getElementById('limite').value;			
			$.ajax({
				url:"/level/?level="+$nivel,				
				complete: function (response) {
					alert(response.responseText);
				},
				error: function () {
				alert('Erro! Não foi possível alterar o limite');
				}
			});  

			return false;
		}
		</script>		
        <p>
            <input type="text"  name="limite" id="limite"><br><br>
			<input type="button" class="btn btn-success" onclick="alterarNivel(); window.location.reload();" value="Alterar Limite">				
        </p>        
    </div>
</div>
