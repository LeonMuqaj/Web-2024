// Kodi i javascript per funksionin e tekstit me fade

const paymentOptionsBold = [
    "MËNYRAT E PAGESËS",
    "TRANSPORT FALAS", 
    "NA KONTAKTONI",
];

const paymentOptionsNormal = [
    "Pagesa cash dhe pagesa me kartë",
    "Në të gjithë Kosovën për porosi mbi vlerën 30.00€",
    "+383 12 345 678",
];

let currentIndex = 0;
const paymentTextBoldElement = document.getElementById('paymentTextBold');
const paymentTextNormalElement = document.getElementById('paymentTextNormal');

function updatePaymentText() {
    paymentTextBoldElement.style.opacity = 0; // Fade out
    paymentTextNormalElement.style.opacity = 0; // Fade out

    setTimeout(() => {
        paymentTextBoldElement.textContent = paymentOptionsBold[currentIndex];
        paymentTextNormalElement.textContent = paymentOptionsNormal[currentIndex];
        
        paymentTextBoldElement.style.opacity = 1; // Fade in
        paymentTextNormalElement.style.opacity = 1; // Fade in

        currentIndex = (currentIndex + 1) % paymentOptionsBold.length;
    }, 500);
}

setInterval(updatePaymentText, 3500);

// Initialize the first text
updatePaymentText();

// //////////////////////////////////////////////////////////////////////////////////////////////

// Kodi i Javascript per funksionin e carouselit
const carouselWrapper = document.getElementById('carouselWrapper');
const images = [
    "Nike.png",
    "adidas.jpg", 
    "Lacoste.jpg",
    "Dior.png",
    "CAT.png",
    "Illyrian.jpg",
    "PhilippPlein.png", 
    "Reebok.png"
];

let currentImageIndex = 0;

function updateCarousel() {
    carouselWrapper.innerHTML = '';
    
    for(let i = 0; i < 4; i++) {
        const index = (currentImageIndex + i) % images.length;
        const img = document.createElement('img');
        img.src = images[index];
        img.className = 'carousel-image';
        img.alt = 'Imazhi';
        carouselWrapper.appendChild(img);
    }
    
    // Funksioni per ndryshimin e imazheve
    currentImageIndex = (currentImageIndex + 4) % images.length;
}

// Inicializo carousel-in
updateCarousel();

// Ndryshimi i imazheve cdo 3 sekonda
setInterval(updateCarousel, 3000);

// //////////////////////////////////////////////////////////////////////////////////////////////



// Pjesa e validimit te inputeve


// Validimi i log-in formes
function validateLoginForm() {
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    if (!emailPattern.test(email)) {
        alert('Invalid email format. It must contain "@" and end with ".com".');
        return false; 
    }

    
    const passwordPattern = /^[A-Z].*\d.*$/; 
    if (!passwordPattern.test(password)) {
        alert('Password must start with a capital letter and include at least one number.');
        return false; 
    }

    return true;
}

// Function to validate the registration form
function validateRegisterForm() {
    const name = document.getElementById('register-name').value;
    const surname = document.getElementById('register-surname').value;
    const phone = document.getElementById('register-phone').value;
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;

    
    const namePattern = /^[A-Za-z]+$/;
    if (!namePattern.test(name)) {
        alert('Name can only contain letters.');
        return false; 
    }
    if (!namePattern.test(surname)) {
        alert('Surname can only contain letters.');
        return false; 
    }

  
    const phonePattern = /^[0-9]+$/; 
    if (!phonePattern.test(phone)) {
        alert('Phone number can only contain numbers.');
        return false; 
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('Invalid email format. It must contain "@" and end with ".com".');
        return false; 
    }

    // Password validation
    const passwordPattern = /^[A-Z].*\d.*$/; 
    if (!passwordPattern.test(password)) {
        alert('Password must start with a capital letter and include at least one number.');
        return false; 
    }

    return true; 
}