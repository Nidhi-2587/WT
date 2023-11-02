
let products = {
    data: [
        {
            productName: "Pedigree Puppy Wet Dog Food, Chicken Chunks in Gravy, 70 g ",
            category: "Wet_Dog_Food",
            price: "675",
            image: "pedigree_wet_dog_food.jpg",
        },
        {
            productName: "Royal Canin German Shepherd Puppy Dry Dog Food ",
            category: "Dry_Dog_Food",
            price: "864",
            image: "royal_canin_german_puppy_food.jpg",
        },
        {
            productName: "Himalaya Healthy Pet Food - Puppy - Chicken & Rice ",
            category: "Dry_Dog_Food",
            price: "774",
            image: "himalayan_puppy_food.jpg",
        },
        {
            productName: "Drools Dry Dog Food for Puppies - Chicken and Egg",
            category: "Dry_Dog_Food",
            price: "679",
            image: "drools_puppy_food.jpg",
        },
        {
            productName: "Chuckit! Dog Toys - Kick Fetch Ball ",
            category: "Dog_Toys",
            price: "2750",
            image: "chuckit_fetch_toy.jpg",
        },
        {
            productName: "KONG Goodie Bone ",
            category: "Dog_Toys",
            price: "810",
            image: "kong_goodie_bone.jpg",
        },
        {
            productName: "Savic Trotter 1 Pet Carrier - Holds up to 5kg ",
            category: "Carriers_&_Travel",
            price: "2115",
            image: "Savic_Trotter.webp",
        },
        {
            productName: "M-Pets Dog Collars - Sportline Collar (Black)",
            category: "Dog_Accessories",
            price: "189",
            image: "M-Pets_Dog_Collars.webp",
        },
    ],
};

for (let i of products.data) {
    //Create Card
    let card = document.createElement("div");
    //Card should have category and should stay hidden initially
    card.classList.add("card", i.category, "hide");
    //image div
    let imgContainer = document.createElement("div");
    imgContainer.classList.add("image-container");
    //img tag
    let image = document.createElement("img");
    image.setAttribute("src", i.image);
    imgContainer.appendChild(image);
    card.appendChild(imgContainer);
    //container
    let container = document.createElement("div");
    container.classList.add("container");
    //product name
    let name = document.createElement("h5");
    name.classList.add("product-name");
    name.innerText = i.productName.toUpperCase();
    container.appendChild(name);
    //price
    let price = document.createElement("h6");
    price.innerText = "₹" + i.price;
    container.appendChild(price);

    card.appendChild(container);
    document.getElementById("products").appendChild(card);
}

//parameter passed from button (Parameter same as category)
function filterProduct(value) {
    //Button class code
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach((button) => {
        //check if value equals innerText
        if (value.toUpperCase() == button.innerText.toUpperCase()) {
            button.classList.add("active");
        } else {
            button.classList.remove("active");
        }
    });

    //select all cards
    let elements = document.querySelectorAll(".card");
    //loop through all cards
    elements.forEach((element) => {
        //display all cards on 'all' button click
        if (value == "all") {
            element.classList.remove("hide");
        } else {
            //Check if element contains category class
            if (element.classList.contains(value)) {
                //display element based on category
                element.classList.remove("hide");
            } else {
                //hide other elements
                element.classList.add("hide");
            }
        }
    });
}

//Search button click
document.getElementById("search").addEventListener("click", () => {
    //initializations
    let searchInput = document.getElementById("search-input").value;
    let elements = document.querySelectorAll(".product-name");
    let cards = document.querySelectorAll(".card");

    //loop through all elements
    elements.forEach((element, index) => {
        //check if text includes the search value
        if (element.innerText.includes(searchInput.toUpperCase())) {
            //display matching card
            cards[index].classList.remove("hide");
        } else {
            //hide others
            cards[index].classList.add("hide");
        }
    });
});

//Initially display all products
window.onload = () => {
    filterProduct("all");
};

//preview

