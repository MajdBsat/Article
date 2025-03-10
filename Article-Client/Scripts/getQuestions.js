let allQuestions = [];

async function fetchQuestions() {
    try {
        const response = await axios.get('http://13.38.47.28/api/getQuestions.php');
        console.log(response.data);

        if (response.data.status === 'success' && Array.isArray(response.data.data)) {
            allQuestions = response.data.data;
            displayQuestions(allQuestions);
        } else {
            console.error("Expected an array of questions, but got:", response.data.data);
            alert("Something went wrong. No questions found.");
        }
    } catch (error) {
        console.error('Error fetching questions:', error.response ? error.response.data : error.message);
        alert("Something went wrong. Please try again.");
    }
}

function displayQuestions(questions) {
    const questionsContainer = document.getElementById('qaContainer');
    questionsContainer.innerHTML = '';

    questions.forEach((questionObj) => {
        const questionElement = document.createElement('div');
        questionElement.classList.add('question');
        questionElement.innerHTML = `
            <h3>${questionObj.question}</h3>
            <p>${questionObj.answer}</p>
        `;
        questionsContainer.appendChild(questionElement);
    });
}

function searchQuestions() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const filteredQuestions = allQuestions.filter(q => 
        q.question.toLowerCase().includes(searchInput) || 
        q.answer.toLowerCase().includes(searchInput)
    );
    displayQuestions(filteredQuestions);
}

document.addEventListener('DOMContentLoaded', fetchQuestions);

document.getElementById('searchInput').addEventListener('input', searchQuestions);
