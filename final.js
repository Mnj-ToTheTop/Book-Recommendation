function validateInput()
    {
        const userInput = document.getElementById("genre").value.trim();
        const messageDiv = document.getElementById('message');

        if(userInput.includes(" "))
        {
            messageDiv.textContent = "Please enter only one word: ";
        }

        else
        {
            messageDiv.textContent = "";
        }
    }
