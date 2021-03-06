<?php 
session_start();
include_once '../database/database_handler.php';
?>
<!doctype html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Téma módosítása - Linktár</title>
	<link rel="shortcut icon" href="../favicon.ico">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css' integrity='sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb' crossorigin='anonymous'>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  </head>
  <body>
  <main role='main' class='container' style='padding-top: 70px;'>
      <div class='class="col-sm-8 mx-auto' align="center">
			<div style="background-color:#eee;border:1px solid black; border-radius: 4px;">
				<h1>Téma módosítása</h1>
				<br>
				<form method="POST">
					<div class="input-group" style="width:40%;">
						<span class="input-group-addon" id="basic-addon1">Téma</span>
						<input type="text" class="form-control" placeholder="..." aria-describedby="basic-addon1" name="theme" style="width:400px;">
					</div> 
					<br>
					<button class='btn btn-outline-info my-2 my-sm-0' type='submit' name="btn-search" id='search'>Keresés</button>
					<br><br>
				</form>
			</div>
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Téma neve</th>
                  <th style="text-align: right;">Műveletek</th>
                </tr>
              </thead>
              <tbody id="list">
				<?php
					$sql = "SELECT * FROM themes WHERE userID = '".$_SESSION['session']."' LIMIT 10;";
					$result = mysqli_query($connection,$sql);
					if(mysqli_num_rows($result)>=1)
					{
						while($row = mysqli_fetch_array($result))
						{
							?>
								<tr>
									<td><input type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="<?php echo $row['name'] ?>" class='name'></td>
									<td style="text-align:right;"><button data-toggle="tooltip" title="Módosítás" type="submit" class="btnmod" name="btnmod" type="button">&#9881;</button>
									<button data-toggle="tooltip" title="Törlés"  type="submit" class="btndel" name="btndel" type="button">&#9940;</button>
									<input type="hidden" value="<?php echo $row['ID']; ?>" class="id" name="id"></td>
								</tr>
							<?php
						}
					}
					else
					{
						?>
							<div class="text-danger">Nincs a keresésnek megfelelő téma.</div>
						<?php
					}
				?>
              </tbody>
            </table>
          </div>
		  <div class='row' id="message">
			
		  </div>
			<br>
			<a href="../">Vissza a főoldalra</a>
		</div>
		
	</main>
	
	<footer style='z-index:1; position:fixed; display:block; right: 0; bottom: 0; left: 0; color: #333; background-color: #EEE; padding-left: 20px'>
		<hr>
      <p>&copy; Copyright - Kőváry László 2017</p>
    </footer>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js' integrity='sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ' crossorigin='anonymous'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
				$('#search').click(function(event){
					event.preventDefault();
					var theme = $('input[name=theme]').val();
					var btnsearch = $('button[name=btn-search]').val();
					$('#list').load('searchtheme.php',{
						theme:theme,
						btnsearch: btnsearch
				});
			});
		});
			
		$(document).on('click', '.btnmod', function(event){
					event.preventDefault();
					var name = $(this).parent().parent().find('[class*="name"]').first().val();
					var id = $( this ).parent().find('[class*="id"]').first().val();
					var btnmod = $('button[name=btnmod]').val();
					$('#message').load('searchtheme.php',{
						name:name,
						id:id,
						btnmod: btnmod
			});
					var theme = $('input[name=theme]').val();
					var btnsearch = $('button[name=btn-search]').val();
					$('#list').load('searchtheme.php',{
						theme:theme,
						btnsearch: btnsearch
				});
		});
		
		$(document).on('click', '.btndel', function(event){
					event.preventDefault();
					var id = $( this ).parent().find('[class*="id"]').first().val();
					var btndel = $('button[name=btndel]').val();
					$('#message').load('searchtheme.php',{
						id:id,
						btndel: btndel
			});
					var theme = $('input[name=theme]').val();
					var btnsearch = $('button[name=btn-search]').val();
					$('#list').load('searchtheme.php',{
						theme:theme,
						btnsearch: btnsearch
				});
		});
		
	</script>
  </body>
</html>