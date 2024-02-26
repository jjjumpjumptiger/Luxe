

function plus(i,j){
var quantity = document.getElementById('quantity_' +  i);
if(Number(quantity.value) < j){
	quantity.value = Number(quantity.value) + 1;
}else{
	alert("Sorry, out of stock!");
}

}

function minus(j){

var quantity = document.getElementById('quantity_' +  j);
	if(quantity.value > 1){
		quantity.value = Number(quantity.value) - 1;
	}

}


function orderSummary(k){
	let html='<table style="width:90%; ">';
	var total = 0;
	for(let i = 1; i <= k; i++){
		var check = document.getElementById('check_' +  i);
		if(check.checked == true){
			var productname = document.getElementById('productname_' +  i).innerHTML;
			var price = document.getElementById('price_' +  i).innerHTML;
			var quantity = document.getElementById('quantity_' +  i).value;
			var priceStr = (''+price).substr(2);
			var priceNum = parseFloat(priceStr);
			html += '<tr><td style="text-align:left;font-size:14px" id="truncateLongTexts">x'+quantity+' '+productname+'</td><td style="text-align:right;font-size:14px">S$ '+priceNum * Number(quantity)+'</td></tr>';
			// html += '<tr><td style="text-align:left;" id="truncateLongTexts">x<lable id="quantity">'+quantity+'</lable> '+productname+'</td><td style="text-align:right;">S$ '+priceNum * Number(quantity)+'</td></tr>';
			total += priceNum * Number(quantity);
			
		}
		
	}
	total = total.toFixed(2);
	html+='</table>';
	var totalprice = document.getElementById('totalprice');
	totalprice.value = "S$ " + total;
	document.getElementById("order_summary").innerHTML = html;
	
}

function checkAll(k){
	var checkall = document.getElementById('checkall');
	if(checkall.checked == true){
		for(let i = 1; i <= k; i++){
			var check = document.getElementById('check_' +  i);
			check.checked = true;
		}
	}else{
		for(let i = 1; i <= k; i++){
			var check = document.getElementById('check_' +  i);
			check.checked = false;
		}
	}
	
}
