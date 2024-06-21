const submitBtn = document.querySelector("#submitMessage")
const form = document.querySelector("#contact_form")

function sendMail() {
    let params = {
        fullname: document.getElementById("fullname").value,
        email: document.getElementById("email").value,
        contact: document.getElementById("contact").value,
        message: document.getElementById("message").value,
    };

    emailjs.send("service_2e0ybkf", "template_c7ehawc", params)
        .then(function(response) {
            alert("Message sent Successfully!!!");
            console.log("Message sent successfully:", response);
            form.reset()
        }, function(error) {
            console.error("Email sending failed:", error);
            alert("Failed to send message. Please try again.");
        });
}

form.addEventListener('submit',(e)=>{
    e.preventDefault()
    sendMail()
    console.log("form submitted")
})

