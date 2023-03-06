
/* Preloader */
/*

window.onload = function () {
  setTimeout(function () {
    document.querySelector("#preloader").style.display = "none";
    document.querySelector(".background-gradient").style.display = "block";
  }, 700);
};

*/


/* Add to cart function with session message */

function addToCart(food_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      alert("Product added to shopping basket!");
    }
  };
  xhttp.open("GET", "addToCart.php?food_id=" + food_id, true);
  xhttp.send();
}