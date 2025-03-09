const question = document.getElementById("question");
const answer = document.getElementById("answer")

async function createQuestion(event) {
    event.preventDefault();
    
    try {
        const response = await axios.post('http://localhost/Article/Article-Server/APIs/V1/addQuestion.php', {
            question: question.value,
            answer: answer.value
        });

        if (response.data.status === 'success') {
            alert('Question added successfully!');
        } else {
            alert('Failed to add question: ' + response.data.message);
        }
    } catch (error) {
        console.error('Error during API request:', error);
        alert('An error occurred. Please try again.');
    }
}