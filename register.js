document.addEventListener("DOMContentLoaded", ()=>{
    function validateForm(event){
        const usernameEx = /\w{3,}/
        const passSize = /[a-zA-Z0-9]{5,}/
        const username = document.getElementById("username")
        const password = document.getElementById("password")
        const confirmPass = document.getElementById("cpassword")
        
        if (!usernameEx.test(username.value)){
            let message = document.createElement("li")
            message.textContent = "Name must be atleast 3 characters!"
            ul.append(message)
        }
        if (!passSize.test(password.value)){
            let message = document.createElement("li")
            message.textContent = "Password must be at least 5 characters!"
            ul.append(message)
        }
        if (password.value != confirmPass.value){
            let message = document.createElement("li")
            message.textContent = "Passwords must match!"
            ul.append(message)
        }
        if (ul.hasChildNodes()){
            /* prevent form from being submitted if there are error messages*/
            event.preventDefault()
        }
    }
    const signup = document.querySelector("#signin")
    
    signup.addEventListener("submit", (event)=>{
        formErrors.innerHTML = null
        formErrors.append(ul)
        document.querySelector("ul").innerHTML = null
        validateForm(event)
        
    })
    
    const formErrors = document.getElementById("formErrors")
    const ul = document.createElement("ul")
})
