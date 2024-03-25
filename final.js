async function getBooks()
{
    const subject = document.getElementById('genre').value.trim();
    const messageDiv = document.getElementById('message');

    if(subject.includes(' '))
    {
        messageDiv.textContent = 'Please eneter only one word: ';
        return;
    }

    const url = `https://openlibrary.org/subjects/${subject.toLowerCase()}.json`;

    try
    {
        const response = await fetch(url);
        const data = await response.json();
        displayBooks(data.works);
    }

    catch(errror)
    {
        console.error('Error fetchibng data: ', error);
    }
}

function displayBooks(works)
{
    const booksDiv = document.getElementById('books');
    booksDiv.innerHTML = '';

    const selectedBooks = works.sort(() => 0.5 - Math.random()).slice(0,5);

    selectedBooks.forEach(book => {
        const bookElement = document.createElement('div');
        bookElement.classList.add('book');

        const coverImageUrl = book.cover_id
        ? `https://covers.openlibrary.org/b/id/${book.cover_id}-M.jpg`
        : 'image2.png';

        bookElement.innerHTML = `
            <img src = "${coverImageUrl}" alt="${book.title}">
            <p class="books-title">Title: ${book.title}</p>
            <p class="books-author">Author: ${book.authors.map(author => author.name).join(', ')}</p>
        `;
        booksDiv.appendChild(bookElement);
    });
}

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