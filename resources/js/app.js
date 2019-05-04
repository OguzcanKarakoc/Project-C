/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import swal from 'sweetalert';
import Chart from 'chart.js';

// window.Vue = require('vue');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function () {

    // region: pagination

    $(".dropdown").hover(
        function () {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,
                true).slideDown("400");
            $(this).toggleClass('open');
        },
        function () {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,
                true).slideUp("400");
            $(this).toggleClass('open');
        }
    );

    // $(window).on('hashchange', function () {
    //   if (window.location.hash) {
    //     const page = window.location.hash.replace('#', '');
    //     if (page == Number.NaN || page <= 0) {
    //       return false;
    //     } else {
    //       getData(page);
    //     }
    //   }
    // });

    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            const myurl = $(this).attr('href');
            const page = $(this).attr('href').split('page=')[1];
            getData(myurl);
        });
    });

    function getData(page) {
        $.ajax(
            {
                url: page,
                type: "get",
                datatype: "html"
            }).done(function (data) {
            $("#ajax_container").empty().html(data);
            // location = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }

    $(document).ready(function () {
        $(".megamenu").on("click", function (e) {
            e.preventDefault();
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // endregion

    // region: cart

    // Add to cart
    $(document).on("click", ".add-cart", function () {
        if (typeof $(this).data('product-id') !== 'undefined') {
            $.ajax({
                type: "POST",
                url: '/add-to-cart', // This is what I have updated
                data: {
                    product_id: $(this).data('product-id'),
                }
            }).done(function (obj) {
                swal({
                    text: obj.name,
                    icon: obj.state
                });
                getCartCount();
            });
        }
    });

    // Add to cart
    $(document).on("input", ".update-cart", function () {
        if (typeof $(this).data('product-id') !== 'undefined') {

            let quantity;
            if ($(this).hasClass('quantity')) {
                quantity = $(this).val();
            } else {
                quantity = $('#quantity').val();
            }

            let subtotal = $(this).parent().next();
            let total = $('.total');

            // console.log($(this).parent().closest('.subtotal').html());

            $.ajax({
                type: "POST",
                url: '/update-cart', // This is what I have updated
                data: {
                    product_id: $(this).data('product-id'),
                    quantity: quantity,
                }
            }).done(function (obj) {
                if (obj.state === 'error') {
                    swal({
                        text: obj.name,
                        icon: obj.state
                    });
                } else {
                    subtotal.html(obj.price);
                    total.text(`Total € ${obj.total}`);
                }
                getCartCount();
            });
        }

    });

    $(document).on('click', '.update-cart-btn', function () {
        if (typeof $(this).data('product-id') !== 'undefined') {
            let quantity;

            if ($(this).hasClass('quantity')) {
                quantity = $(this).val();
            } else {
                quantity = $('#quantity').val()
            }

            $.ajax({
                type: "POST",
                url: '/update-cart', // This is what I have updated
                data: {
                    product_id: $(this).data('product-id'),
                    quantity: quantity,
                }
            }).done(function (obj) {
                console.log(obj);
                swal({
                    text: obj.name,
                    icon: obj.state
                });
                getCartCount();
            });
        }

    });
    $('.quantity-right-plus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        // If is not undefined
        $('#quantity').val(quantity + 1);
        // Increment
    });
    $('.quantity-left-minus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        // If is not undefined
        // Increment
        if (quantity > 1) {
            $('#quantity').val(quantity - 1);
        }
    });

    $(document).on("click", ".cart-delete", function () {
        var id = $(this).data("product-id");
        var $this = $(this);
        $.ajax({
            url: "/cart/delete/" + id,
            type: 'DELETE',
            data: {
                product_id: id,
            }
        }).done(function ($result) {
            $this.closest('tr').remove();
            getCartCount();
        });
    });

    function getCartCount() {
        $.ajax({
            type: "GET",
            url: '/get-cart', // This is what I have updated
            data: {}
        }).done(function (cart) {
            const obj = JSON.parse(cart);
            let count = 0;

            for (let prop in obj) {
                count = count + obj[prop];
            }
            $('.cart-badge').html(count);
        });
    }

    getCartCount();

    // endregion

    $(".delete-pros-cons").click(function (event) {
        $.ajax({
            type: "DELETE",
            url: '/deleteProsCons', // This is what I have updated
            data: {
                id: $(this).data('pros-cons-id')
            }
        }).done(function (obj) {
            swal({
                text: obj.name,
                icon: obj.state
            });
            $(`#pros-cons-${obj.id}`).remove();
        });
    });

    $("#rating-form").on('submit', function () {
        var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
        $.ajax({
            type: "POST",
            url: '/updateRating', // This is what I have updated
            data: formdata
        }).done(function (obj) {
            swal({
                text: obj.name,
                icon: obj.state,
            })
                .then(() => {
                    location.reload();
                });
            $('.avg-rating').html(obj.avgRating);
        });
        event.preventDefault();
    });

    $("#add-pros").click(function (event) {
        $("#pros").append(
            "<div class='row mb-3'><div class='col-12'><input type='text' name='pros[]' placeholder='PRO' class='form-control'/></div></div>")
    });

    $("#add-cons").click(function (event) {
        $("#cons").append(
            "<div class='row mb-3'><div class='col-12'><input type='text' name='cons[]' placeholder='CON' class='form-control'/></div></div>")
    });

    //getchartprofit

    var chart = null;
    var profitChart = null;
    $.ajax({
        type: "get",
        url: '/getchartquantity',
        data: {
            date_format: 'months'
        },
    }).done(function (obj) {
        chart = new Chart(document.getElementById("line-chart-sold"), {
            type: 'line',
            data: {
                labels: obj.labels,
                datasets: [{
                    data: obj.quantityChart,
                    label: "Product quantity sold",
                    borderColor: "#3e95cd",
                    fill: true
                }
                ]
            },
            options: {
                title: {
                    display: false,
                    text: ''
                }
            }
        });
    });

    $.ajax({
        type: "get",
        url: '/getchartprofit',
        data: {
            date_format: 'months'
        },
    }).done(function (obj) {
        profitChart = new Chart(document.getElementById("line-chart-profit"), {
            type: 'line',
            data: {
                labels: obj.labels,
                datasets: [{
                    data: obj.profitChart,
                    label: "Profit",
                    borderColor: "#cd8d3b",
                    fill: true
                },
                    {
                        data: obj.salesChart,
                        label: "Sales",
                        borderColor: "#3e95cd",
                        fill: true
                    }]
            },
            options: {
                title: {
                    display: false,
                    text: ''
                }
            }
        });
    });

    $("#line-profitchart-date").change(function () {
        $.ajax({
            type: "get",
            url: '/getchartprofit',
            data: {
                date_format: $(this).val()
            },
        }).done(function (obj) {

            profitChart.data.labels.pop();
            // profitChart.data.datasets.forEach((dataset) => {
            //   dataset.data.pop();
            // });
            profitChart.update();

            profitChart.data.labels = obj.labels;

            profitChart.data.datasets[0].data = obj.profitChart;
            profitChart.data.datasets[1].data = obj.salesChart;

            profitChart.update();
        });
    });

    $("#line-chart-date").change(function () {
        $.ajax({
            type: "get",
            url: '/getchartquantity',
            data: {
                date_format: $(this).val()
            },
        }).done(function (obj) {

            chart.data.labels.pop();
            chart.data.datasets.forEach((dataset) => {
                dataset.data.pop();
            });
            chart.update();

            chart.data.labels = obj.labels;
            chart.data.datasets.forEach((dataset) => {
                dataset.data = obj.quantityChart;
            });
            chart.update();
        });
    });

});
