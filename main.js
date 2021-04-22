document.addEventListener("DOMContentLoaded", init);

function init() {
  sltLanguage.addEventListener("change", selectLanguage);

  //Declare event listeners to all icons used to copy section link
  Array.prototype.forEach.call(
    document.querySelectorAll(".iconsToCopySection"),
    function (el) {
      el.addEventListener("click", copySectionLink);
    }
  );
}

//Select the language by changing the cookie and reloading the page
function selectLanguage() {
  document.cookie = "lang=" + sltLanguage.value;
  window.location.hash = "";
  window.location.reload();
}

//Copy the section link with its anchor
function copySectionLink(e) {
  icon = e.target;
  link = icon.getAttribute("data-hrefcopy");
  if (link == null) {
    link = link = icon.parentNode.getAttribute("data-hrefcopy"); //if link not found, search in the parent
  }
  if (link != null) {
    //copy the full link (= domain name + querystring + anchor)
    console.log(navigator.clipboard.writeText(link));

    //Foreach icons, remove green style
    Array.prototype.forEach.call(
      document.querySelectorAll(".iconsToCopySection"),
      function (el) {
        el.firstChild.classList.replace("bg-green-300", "bg-gray-200");
        el.firstChild.classList.replace(
          "hover:bg-green-300",
          "hover:bg-gray-300"
        );
      }
    );

    //For the icon clicked, add the green style
    icon.classList.replace("bg-gray-200", "bg-green-300");
    icon.classList.replace("hover:bg-gray-300", "hover:bg-green-300");
  }
}
