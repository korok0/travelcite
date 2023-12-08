
function changeLogButton(){
    const log = document.querySelector(".sign_in")
    log.textContent = "Logout"
    log.href = "logout.php"
}
function lockReview(){
    const rating = document.querySelector("#ratingMenu")
    rating.setAttribute("disabled", true)
    const review = document.querySelector("#reviewSubmit")
    review.setAttribute("disabled", true)
}



