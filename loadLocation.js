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
    const locationName = document.querySelector(".location")
    const locationDesc = document.querySelector(".description p")
    const activityCol = document.querySelector(".col")
    const imge = document.querySelector(".imge")
    const description = document.querySelector(".description p")
    const ratingDesc = document.querySelector(".rating p")
    const reviewsDesc = document.querySelector("#reviews p")
    reviewsDesc.textContent = "Liked your visit? Didn't like it? Share your experiences to the world!"
    ratingDesc.textContent = "This will contain an html input form so that user can leave a rating. Rating will be kept in a database and when a new review is entered, a simple calculation will be done to update the number."
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
