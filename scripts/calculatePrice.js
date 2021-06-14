//Initialize variable to hold prises for every type.
let typeCost = 0;
let wholeWheatCost = 0;

let toppingsSelected = [];
let toppingsCost = 0;

let amount = 0;
let amountCost = 0;



function updateOrdSumm(fieldData, field)
{

    // Type costs
//============================================================================================================//
    if (field === 'type') {
        if ((fieldData.value).trim() === "Regular") {typeCost = 1.00}       // Regular
        else if ((fieldData.value).trim() === "Stuffed") {typeCost = 2.00}  // Stuffed
        else {typeCost = 1.00}                                              // Bitesize

        //Display progress
        document.getElementById("getType").innerHTML = "Pretzel Type: " + (fieldData.value).trim();
    }
//____________________________________________________________________________________________________________//


    // Whole wheat totalCost ($1 whole wheat)
//============================================================================================================//
    if (field === 'wholeWheat') {
        let getCheckBox = document.getElementById("isWholeWheat").checked;
        if (getCheckBox) {
            wholeWheatCost = 1.00
            document.getElementById("getWheat").innerHTML = "Whole Wheat: Yes";

            //change amount cost if whole wheat is selected
            amountCost = (amount * 0.25);
        }
        else {
            wholeWheatCost = 0
            document.getElementById("getWheat").innerHTML = "Whole Wheat: No";

            //change amount cost if whole wheat is NOT selected
            amountCost = (amount * 0.20);
        }
    }
//____________________________________________________________________________________________________________//


    // Toppings ($0.25 per topping)
//============================================================================================================//
    if (field === 'toppings') {
        let getVal = fieldData.value;

        // add value of field (topping name) to the toppingsSelected array, if the
        // topping was selected
        if (fieldData.checked){
            toppingsSelected.push(getVal); // add topping to array if value was selected
        }
        //if topping is not selected and it is in the selected array, delete it.
        else{
            if(toppingsSelected.includes(getVal)) { //check does topping in array
                const index = toppingsSelected.indexOf(getVal);//look for topping index
                if (index > -1) {
                    toppingsSelected.splice(index, 1); // delete first element under that index
                }
            }
        }

        // Calculate topping price based on selected elements
        toppingsCost = toppingsSelected.length * 0.25;

        // Display toppings on the page
        document.getElementById("getToppings").innerHTML = "Toppings: " + toppingsSelected.join(" + ");
    }
//____________________________________________________________________________________________________________//


    // Stuffing Cost
//============================================================================================================//
    //TODO:
//____________________________________________________________________________________________________________//


    // Sauce Cost
//============================================================================================================//
    //TODO:
//____________________________________________________________________________________________________________//


    // Amount totalCost ($0.20 per regular, $0.25 per whole wheat)
//============================================================================================================//
    //execute only if bite size selected, otherwise do not display amount
    if(document.getElementById("Bitesize").checked) {
    if (field === "amount") {

            // Set the amount according user input
            amount = fieldData.value;

            // if amount less than 1 - set to 1.
            if (amount < 1) {
                amount = 1;
            }

            // change the price according isWholeWheat selection
            if (document.getElementById("isWholeWheat").checked) {
                amountCost = (amount * 0.25);
            } else {
                amountCost = (amount * 0.20);
            }
            //display amount on the page
            document.getElementById("getAmount").innerText = "Amount: " + amount;
        }
    }
    // bite size NOT selected then set proper price and message
    else {
        amountCost = 0;
        document.getElementById("getAmount").innerText = "Amount: ";
    }
//____________________________________________________________________________________________________________//


    // Calculate total cost
    let totalCost = typeCost + wholeWheatCost + toppingsCost + amountCost;

    // Set total cost ot appropriate format
    let costDisplay = "$" + totalCost.toFixed(2);

    // Display total cost on html page
    document.getElementById("pretzelCost").innerText = costDisplay;
}


/*
function updateOrdSumm(fieldData, field)
{
    // Grabs default cost from HTML (0.00)
    let cost = document.getElementById("pretzelCost").innerText;
    cost = cost.substring(1, cost.length).trim();
    cost = parseFloat(cost);

    // Type costs
    if (field === 'type') {
        if ((fieldData.value).trim() === "Regular") {cost = 1.00}       // Regular
        else if ((fieldData.value).trim() === "Stuffed") {cost = 2.00}  // Stuffed
        else {cost = 1.00}                                              // Bitesize

        //Display progress
        document.getElementById("getType").innerHTML = "Pretzel Type: " + (fieldData.value).trim();
    }

    // Whole wheat cost ($1 whole wheat)
    if (field === 'wholeWheat') {
        let getCheckBox = document.getElementById("isWholeWheat").checked;
        if (getCheckBox) {
            cost += 1.00
            document.getElementById("getWheat").innerHTML = "Whole Wheat: True";
        }
        else {
            cost -= 1.00
            document.getElementById("getWheat").innerHTML = "Whole Wheat: False";
        }
    }

    // Toppings ($0.25 per topping)
    if (field === 'toppings') {
        let getVal = fieldData.value;

        if (fieldData.checked) {
            cost += 0.25
            document.getElementById("getToppings").innerHTML += (getVal + " ");
        }
        else {
            cost -= 0.25;
            document.getElementById("getToppings").innerText -= getVal;
        }

    }

    // Stuffing Cost

    // Sauce Cost

    // Amount cost ($0.20 per regular, $0.25 per whole wheat)
    if (field === "amount") {
        let totCost = 0.00;
        if (document.getElementById("isWholeWheat").checked) {
            totCost = (fieldData.value * 0.25);
        }
        else {
            totCost = (fieldData.value * 0.20);
        }
        cost += totCost;
        document.getElementById("getAmount").innerText = "Amount: " + fieldData.value;
    }

    let costDisplay = "$" + cost.toFixed(2);
    document.getElementById("pretzelCost").innerText = costDisplay;
}
*/