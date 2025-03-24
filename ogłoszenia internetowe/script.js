
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("offerModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.querySelector(".close");
    const offerForm = document.getElementById("offerForm");

    if (!modal || !openModalBtn || !closeModalBtn || !offerForm) {
        console.error("Błąd: Nie znaleziono elementów modala!");
        return;
    }

    openModalBtn.addEventListener("click", function() {
        modal.style.display = "flex";
    });

    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    offerForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = {
            title: offerForm.querySelector('input[name="title"]:checked')?.value,
            description: offerForm.querySelector('textarea[name="description"]').value
        };

        if (!formData.title || !formData.description) {
            alert("Wypełnij wszystkie pola!");
            return;
        }

        fetch("add_offer.php", {
    method: "POST",
    body: JSON.stringify(formData),
    headers: { "Content-Type": "application/json" }
})
.then(response => {
    console.log('Raw response:', response); // Zobacz, co zwraca serwer
    return response.json(); // Parsowanie JSON
})
.then(data => {
    console.log("Odpowiedź serwera:", data);
    if (data.status === "success") {
        alert("Ogłoszenie dodane!");
        modal.style.display = "none";
        window.location.reload();
    } else {
        alert("Błąd: " + data.message);
    }
})
.catch(error => console.error("Błąd wysyłania formularza:", error));
    
window.location.reload();
    });
    
});


function removeOffer(x)
{   
   // console.log(x);
    fetch("removeOffer.php",{
        method: "POST",
        body: JSON.stringify({offerId: x}),
        headers: { "Content-Type": "application/json"}
    })
    .then(response => response.text())
    .then(data => {
        console.log("serwer odpowiedział",data);
        window.location.reload();
    })
    .catch(error => console.error("Błąd",error));
}