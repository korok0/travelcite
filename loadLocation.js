function load(name){
    // country object has attributes like description, images, etc
    // use the country object to build a location specific page
    let location;
    console.log(locations)
    // build country page
    for (const lo of locations){
        if (lo.name.toLowerCase() == name.toLowerCase()){
            location = lo
            console.log("1")
        }
    }
    const locationLinks = document.querySelector(".locationLinks")
    const locationName = document.querySelector(".location")
    const locationDesc = document.querySelector(".description p")
    const activityCol = document.querySelector(".col")
    const imge = document.querySelector(".imge")
    const description = document.querySelector(".description p")
    description.textContent = location.description
    activityCol.innerHTML = ""
    imge.style.backgroundImage = "none"
    imge.style.backgroundImage = `url("${location.backgroundImage}")`
    locationName.textContent = location.name
    locationDesc.textContent = location.description

    // Load the "Things To Do section"
    for(const activity of location.activites){
        const activityElement = document.createElement("div")
        const img = document.createElement("img")
        const p = document.createElement("p")
        img.src = activity.image
        p.textContent = activity.description
        activityElement.className = "activity"
        activityElement.append(img)
        activityElement.append(p)
        activityCol.append(activityElement)
    }

}


function loadMultipleLocations() {
    const container = document.querySelector('.location-cards-container'); // Adjust the selector as needed

    locations.forEach(location => {
        const link = document.createElement('a');
        link.href = `location.php?location=${location.name.toLowerCase()}`; // Assuming file names match the location names in lowercase


        const card = document.createElement('div');
        card.className = 'location-card';
        card.innerHTML =  `
        <div class="card-image" style="background-image: url('${location.backgroundImage}')"></div>
        <h3 class = "locationlink">${location.name}</h3>
    `;
        link.appendChild(card);
        container.appendChild(link);
    });
}
function displayUsername(username){
    let reviewDialogue = "Liked your visit? Didn't like it? "
    if(username.toLowerCase() == "guest"){
        reviewDialogue += "Login to share your experiences to the world!"
    }
    else{
        reviewDialogue += `Tell everyone about your experience, ${username}!`
    }
    const reviewsDesc = document.querySelector("#reviews p")
    reviewsDesc.textContent = reviewDialogue
    
}
function loadReviews(username, rating, review){
    console.log(typeof username)
    console.log(username)
    const userReviewBox = document.getElementById("reviews")
    const userNameBox = document.createElement("div")
    userNameBox.innerHTML = 
    `
    <div>
    <p>User:<br> ${username}</p>
    <p>Rating:<br> ${rating}</p>
    </div>
    <div class='reviewMessage'><p>${review}</p></div>
    
    `
    userReviewBox.appendChild(userNameBox)
    userNameBox.className = "userReview"
    
}
function displayAverageRating(ratingTotal, count){
    ratingAverage = ratingTotal / count
    if(!isNaN(ratingAverage)){
        locationRating = document.querySelector(".rating h3")
        locationRating.textContent = `${ratingAverage.toFixed(1)}`
    }
}
function loadSources(name) {
    let source;
    for (const s of sources){
        // set find source object that matches the location
        if (s.location.toLowerCase() == name.toLowerCase()){
            source = s
        }
    }
    // search through different places in the links array
    for(const place of source.links){
        const a = document.createElement("a")
        a.href = place.link
        a.target = "_blank"
        a.textContent = place.name
        document.querySelector(".locationLinks").append(a)
    }

}