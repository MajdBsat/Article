const email = document.getElementById("email");
const password = document.getElementById("password");

async function loginUser(event) {
    event.preventDefault();

    try {
        const response = await axios.post("http://13.38.47.28/api/signIn.php", {
            email: email.value,
            password: password.value,
        });

        console.log(response);

        if (response.data.status === "success") {
            alert("Login successful!");
            window.location.href = "home.html";
        } else {
            alert("Error: " + (response.data ? response.data.message : 'Unknown error'));
        }
    } catch (error) {
        console.error("Error during login:", error.response ? error.response.data : error.message);
        alert("Something went wrong. Please try again.");
    }
}
