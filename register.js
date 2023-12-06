document.addEventListener("DOMContentLoaded", ()=>{
    function validateForm(){




        if (ul.hasChildNodes()){
            formErrors.className = ""
        }
        else {
            
            
        }
    }
    const box = document.querySelector(".box")
    
    box.addEventListener("click", (event)=>{
        formErrors.innerHTML = null
        formErrors.append(ul)
        validateForm()
        event.preventDefault()
    })
    const formErrors = document.getElementById("formErrors")
    const ul = document.createElement("ul")
})
