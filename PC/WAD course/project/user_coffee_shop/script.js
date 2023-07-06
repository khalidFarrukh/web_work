const isHidden = elem => {
    const styles = window.getComputedStyle(elem)
    return styles.display === 'none' || styles.visibility === 'hidden'
}

function show(target) {
    document.getElementById(target).style.visibility = 'visible';
}

function hide(target) {
    document.getElementById(target).style.visibility = 'hidden';
}

function show_and_hide(target) {
    const elem = document.getElementById(target);
    if (isHidden(elem)) {
        show(target);
    } else {
        hide(target);
    }
}
const element = document.getElementById("products");
var currently_selected_category = "category_0";

function show_product_list(target, self) {
    var ajax1 = new XMLHttpRequest();
    ajax1.open("GET", "distinct_categories.php", true);
    ajax1.send();
    ajax1.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data1 = JSON.parse(this.responseText);
            for (var i = 0; i < data1.length; i++) {
                var under_scored_pcategory = "category_" + String(i);
                var under_scored_pcategory_product_list = under_scored_pcategory + "_product_list";
                if (self == under_scored_pcategory && target == under_scored_pcategory_product_list) {
                    document.getElementById(under_scored_pcategory).style.backgroundColor = 'rgb(255, 156, 43)';
                    // show(under_scored_pcategory_product_list);
                    currently_selected_category = under_scored_pcategory;
                    console.log(currently_selected_category);
                    if (currently_selected_category == under_scored_pcategory) {
                        console.log("hello");
                        var ajax2 = new XMLHttpRequest();
                        ajax2.open("GET", "product_list.php?category=" + data1[i]['pcategory'], true);
                        ajax2.send();
                        ajax2.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                var data2 = JSON.parse(this.responseText);
                                console.log(data2);
                                element.innerHTML = '';
                                for (var j = 0; j < data2.length; j++) {
                                    const a_tag = document.createElement("a");
                                    a_tag.href = "#";
                                    const div_1 = document.createElement("div");
                                    div_1.className = "pimage";
                                    const product_img = document.createElement("img");
                                    product_img.src = "https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
                                    product_img.alt = "product_image";
                                    div_1.appendChild(product_img);
                                    a_tag.appendChild(div_1);

                                    const div_2 = document.createElement("div");
                                    div_2.className = "pname";
                                    const p_1_div_2 = document.createElement("p");
                                    p_1_div_2.innerHTML = data2[j]['pname'];
                                    div_2.appendChild(p_1_div_2);
                                    a_tag.appendChild(div_2);

                                    const div_3 = document.createElement("div");
                                    div_3.className = "pprice";
                                    const p_1_div_3 = document.createElement("p");
                                    p_1_div_3.innerHTML = "Rs." + data2[j]['pprice'];
                                    div_3.appendChild(p_1_div_3);
                                    a_tag.appendChild(div_3);
                                    element.appendChild(a_tag);
                                }
                            }
                        }
                    }

                }
                else {
                    document.getElementById(under_scored_pcategory).style.backgroundColor = 'rgb(255, 186, 106';
                    // hide(under_scored_pcategory_product_list);
                }
            }
        }
    }
}

function quantity_add(quantity_id) {
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    quantity += 1;

    document.getElementById(quantity_id).innerHTML = String(quantity);
}

function quantity_reduce(quantity_id) {
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    if (quantity > 0) {
        quantity -= 1;
    }
    document.getElementById(quantity_id).innerHTML = String(quantity);
}

var ajax1 = new XMLHttpRequest();
ajax1.open("GET", "distinct_categories.php", true);
ajax1.send();
ajax1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var data1 = JSON.parse(this.responseText);
        for (var i = 0; i < data1.length; i++) {
            console.log(data1[i]);
            var under_scored_pcategory = "category_" + String(i);
            var under_scored_pcategory_product_list = under_scored_pcategory + "_product_list";
            console.log(currently_selected_category);
            if (currently_selected_category == under_scored_pcategory) {
                console.log("hello");
                var ajax2 = new XMLHttpRequest();
                ajax2.open("GET", "product_list.php?category=" + data1[i]['pcategory'], true);
                ajax2.send();
                ajax2.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var data2 = JSON.parse(this.responseText);
                        console.log(data2);
                        for (var j = 0; j < data2.length; j++) {
                            const a_tag = document.createElement("a");
                            a_tag.href = "#";
                            const div_1 = document.createElement("div");
                            div_1.className = "pimage";
                            const product_img = document.createElement("img");
                            product_img.src = "https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
                            product_img.alt = "product_image";
                            div_1.appendChild(product_img);
                            a_tag.appendChild(div_1);

                            const div_2 = document.createElement("div");
                            div_2.className = "pname";
                            const p_1_div_2 = document.createElement("p");
                            p_1_div_2.innerHTML = data2[j]['pname'];
                            div_2.appendChild(p_1_div_2);
                            a_tag.appendChild(div_2);

                            const div_3 = document.createElement("div");
                            div_3.className = "pprice";
                            const p_1_div_3 = document.createElement("p");
                            p_1_div_3.innerHTML = "Rs." + data2[j]['pprice'];
                            div_3.appendChild(p_1_div_3);
                            a_tag.appendChild(div_3);
                            element.appendChild(a_tag);
                        }
                    }
                }
            }
        }
    }
}
// const a_tag = document.createElement("a");
// a_tag.href = "#";
// const div_1 = document.createElement("div");
// div_1.className = "pimage";
// const product_img = document.createElement("img");
// product_img.src = "https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
// product_img.alt = "product_image";
// div_1.appendChild(product_img);
// a_tag.appendChild(div_1);

// const div_2 = document.createElement("div");
// div_2.className = "pname";
// const p_1_div_2 = document.createElement("p");
// p_1_div_2.innerHTML = "product name";
// div_2.appendChild(p_1_div_2);
// a_tag.appendChild(div_2);

// const div_3 = document.createElement("div");
// div_3.className = "pprice";
// const p_1_div_3 = document.createElement("p");
// p_1_div_3.innerHTML = "price";
// div_3.appendChild(p_1_div_3);
// a_tag.appendChild(div_3);
// element.appendChild(a_tag);
