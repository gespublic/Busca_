<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
let foundTxtPosition = 0;
const classTxtFoundInSearch = 'txt-found-in-search';
const findInDocument = (positionSelection) => {
  const positionToFind = positionSelection.position;
  let txt = document.querySelector('#txt-to-find').value;
  const cleanFind = () => {
    $("*").removeClass(classTxtFoundInSearch);
  } 
  if(txt.trim() == ""){  
    cleanFind();
    return;
  }     
  let $txtElement =  $(`p:contains('${txt}'), span:contains('${txt}')`);
  foundTxtPosition = foundTxtPosition + (positionToFind);
  if(foundTxtPosition == 0 || !$txtElement.length || $txtElement[foundTxtPosition - 1] >= $txtElement.length){
    cleanFind();
  }
  $txtElement = $txtElement[foundTxtPosition];
  if(typeof($txtElement) === "undefined"){     
    foundTxtPosition = foundTxtPosition - (positionToFind);
  }else{
    cleanFind();
    $($txtElement).addClass(classTxtFoundInSearch);
    if($($txtElement).length){
      let txtElementTopPosition = $($txtElement).offset().top;
      window.scrollTo(0, txtElementTopPosition);  
    }
  }
}
</script>

<style css>
.find-in-document-container{
  background-color:#013483 ;
 box-shadow: 2px 2px 5px 2px #ccc;
  padding: 5px;
  position: fixed;
  bottom: 10px;
  min-width: 45%;
 width: auto;
border-radius: 7px;
  z-index: 9999;
}
.txt-found-in-search{
  background-color: #ff0;
  }
</style>

 <div class="find-in-document-container d-none d-lg-block">
 

	<form onsubmit="return false;">
		<div class="row">
			<div class="col-8">
				<input type="text" class="form-control" placeholder="Pesquisar nesta página..." id="txt-to-find" value="" onchange="findInDocument({position: 1}" oninput="findInDocument({position: 0})">
			</div>
			<div class="col-4">
			<div class="btn-group" role="group" aria-label="Navegar">
				<button type="button" class="btn btn-success" onclick="findInDocument({position: -1})">Anterior</button>
				<button type="button" class="btn btn-success" onclick="findInDocument({position: 1})">Próximo</button>
			</div>
			</div>
		</div>
</form>
</div>
