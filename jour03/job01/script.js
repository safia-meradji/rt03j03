var showButton = document.getElementById("showButton");
var hideButton = document.getElementById("hideButton");
var text = document.getElementById("text");

showButton.addEventListener("click", function() {
    text.innerHTML = "Les logiciels et les cathédrales, c'est un peu la même chose - d'abord on les construit, ensuite on prie.";
    text.style.display = "block";
});

hideButton.addEventListener("click", function() {
    text.style.display = "none";
});
