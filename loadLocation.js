// might put this in a json
const countries = 
[{

    
        "name": "France",
        "backgroundImage": "images/france-paris.jpg",
        "description": "a country in Western Europe",
        "activites": [
            { "image": "images/france-paris.jpg",
              "description": "Some description of things to do"
            },
            { "image": "images/france-country.jpg",
              "description": "Some description of things to do"
            }
        ]  
    },
    {

    
        "name": "Salem",
        "backgroundImage": "images/salem-home.jpg",
        "description": "a city in Massachusetts",
        "activites": [
            { "image": "images/salem-statue.jpg",
              "description": "Some description of things to do"
            },
            { "image": "images/salem-home.jpg",
              "description": "Some description of things to do"
            }
        ]  
    }  
]

function load(name){
    // country object has attributes like description, images, etc
    // use the country object to build a location specific page
    let country;
    console.log(countries)
    // build country page
    for (const co of countries){
        if (co.name == name){
            country = co
            console.log("1")
        }
    }
    const countryName = document.querySelector(".location")
    const countryDesc = document.querySelector(".description p")
    const activityCol = document.querySelector(".col")
    const imge = document.querySelector(".imge")
    const description = document.querySelector(".description p")
    const ratingDesc = document.querySelector(".rating p")
    const reviewsDesc = document.querySelector("#reviews p")
    reviewsDesc.textContent = "This could contain a text area where user can leave a comment"
    ratingDesc.textContent = "This will contain an html input form so that user can leave a rating. Rating will be kept in a database and when a new review is entered, a simple calculation will be done to update the number."
    description.textContent = country.description

    activityCol.innerHTML = ""
    imge.style.backgroundImage = "none"
    imge.style.backgroundImage = `url("${country.backgroundImage}")`
    countryName.textContent = country.name
    countryDesc.textContent = country.description

    // Load the "Things To Do section"
    for(const activity of country.activites){
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
