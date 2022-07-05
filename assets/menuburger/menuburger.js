//recuperer toogle et body
let icon = document.getElementById("icon");
// declarer sa variable "icon" cette variable pour donner l'élément dans le html qui a pour id="icon" 
icon.addEventListener('click',function(){
//add eventlistener methode pour ecouter les interaction avec le click qui lance  la function
    let menuburger= document.getElementById("menuburger");
// sert a recup id menuburger 
    menuburger.classList.toggle('displaynone');
// methode qui  permet de changer un element html ici avec toogle on la classe dispaly none si elle 
//ye est pas et on enleve si elle y est
});
    