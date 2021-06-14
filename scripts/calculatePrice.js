//Initialize variable to hold prises for every type.
let typeCost = 0;
let wholeWheatCost = 0;

let toppingsSelected = [];
let toppingsCost = 0;

let amount = 0;
let amountCost = 0;
let amountCoefficient = 0.20; //$0.20 per regular, $0.25 per whole wheat



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
        document.getElementById("typeValue").innerHTML = "+ $" + typeCost.toFixed(2);
    }
//____________________________________________________________________________________________________________//


    // Whole wheat totalCost ($1 whole wheat)
//============================================================================================================//
    if (field === 'wholeWheat') {
        let getCheckBox = document.getElementById("isWholeWheat").checked;
        if (getCheckBox) {
            wholeWheatCost = 1.00
            document.getElementById("getWheat").innerHTML = "Whole Wheat";
            document.getElementById("wheatValue").innerHTML = "+ $" + wholeWheatCost.toFixed(2);

            //change amount cost if whole wheat is selected
            amountCoefficient = 0.25;
            amountCost = (amount * amountCoefficient);

            // If Bitesize selected. Display correct message for bitesize, since coefficient was changed
            if(document.getElementById("Bitesize").checked) {
                document.getElementById("amountValue").innerText =
                    "+ $" + amountCost.toFixed(2) +
                    " (" + amount + " x $" + amountCoefficient.toFixed(2) + ")";
            }else {
                document.getElementById("amountValue").innerText = "";
            }
        }
        else {
            wholeWheatCost = 0
            document.getElementById("getWheat").innerHTML = "";
            document.getElementById("wheatValue").innerHTML = "";

            //change amount cost if whole wheat is NOT selected
            amountCoefficient = 0.20;
            amountCost = (amount * amountCoefficient);


            // If Bitesize selected. Display correct message for bitesize, since coefficient was changed
            if(document.getElementById("Bitesize").checked) {
                document.getElementById("amountValue").innerText =
                    "+ $" + amountCost.toFixed(2) +
                    " (" + amount + " x $" + amountCoefficient.toFixed(2) + ")";
            }else {
                document.getElementById("amountValue").innerText = "";
            }
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

        // Display toppings and price on the page
        document.getElementById("getToppings").innerHTML =
            "Toppings: " + toppingsSelected.join(" + ");

        document.getElementById("toppingsValue").innerHTML =
            "+ $" + toppingsCost + " (" + toppingsSelected.length + " x $0.25)"
    }
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
                amountCoefficient = 0.25; //set correct coefficient for whole wheat
                amountCost = (amount * amountCoefficient);
            } else {
                amountCoefficient = 0.20; //set correct coefficient for NOT whole wheat
                amountCost = (amount * amountCoefficient);
            }
            //display amount on the page
            document.getElementById("getAmount").innerText = "Bitesize Amount: " + amount;

            document.getElementById("amountValue").innerText =
                "+ $" + amountCost.toFixed(2) +
                " (" + amount + " x $" + amountCoefficient.toFixed(2) + ")";
        }
    }
    // bite size NOT selected then set proper price and message
    else {
        amountCost = 0;
        document.getElementById("getAmount").innerText = "";
    }
//____________________________________________________________________________________________________________//


    // Calculate total cost
    let totalCost = typeCost + wholeWheatCost + toppingsCost + amountCost;

    // Set total cost ot appropriate format
    let costDisplay = "Total: $" + totalCost.toFixed(2);

    // Display total cost on html page
    document.getElementById("pretzelCost").innerText = costDisplay;
}
