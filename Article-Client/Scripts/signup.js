    const fullname = document.getElementById("name");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    async function signupUser(event) {
    event.preventDefault();
    
    try {
        const response = await axios.post("http://localhost/Article/Article-Server/APIs/V1/signUp.php", {
            fullname: fullname.value,
            email: email.value,
            password: password.value,
        });

        if (response.data.status === 'success') {
            alert("Signup successful!");
        } else {
            alert(response.data.message);
        }
    } catch (error) {
        console.error("Error during signup:", error.response ? error.response.data : error.message);
        alert("Something went wrong. Please try again.");
    }
}
