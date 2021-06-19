$(document).ready(function () {
  //trier par categorie
  $(".categories").on("change", function () {
    $.ajax({
      url: "get_products_by_category.php",
      data: {
        id: this.value,
      },
      success: (response) => {
        $(".products").html(response);
      },
    });
  });

  //trier par prix
  $(".sortable").on("change", function () {
    $.ajax({
      url: "sort_products.php",
      data: {
        direction: this.value,
      },
      success: (response) => {
        $(".products").html(response);
      },
    });
  });

  //ajouter un produit au panier
  $(".addToCart").click(function (e) {
    e.preventDefault();
    let $form = $(this).parents(".form");
    let id = $form.find(".id").val();
    let name = $form.find(".name").val();
    let price = $form.find("#price").val();
    let image = $form.find(".image").val();
    let qty = $form.find(".quantity").val();

    $.ajax({
      url: "add_to_cart.php",
      method: "POST",
      data: {
        id,
        name,
        price,
        qty,
        image,
      },
      success: (response) => {
        $("#message").html(response);
        numberOfProductsInCart();
        window.scrollTo(0, 0, "smooth");
      },
    });
  });

  //changer la quantite d'un produit
  $(".qty").on("change", function () {
    let $product = $(this).closest("tr");
    let id = $product.find(".id").val();
    let price = $product.find(".price").val();
    let qty = $product.find(".qty").val();
    $.ajax({
      url: "update_product_in_cart.php",
      method: "post",
      data: {
        qty,
        id,
        price,
      },
      success: () => {
        location.reload();
      },
    });
  });

  //ajouter un order
  $("#checkout").submit(function (e) {
    e.preventDefault();
    let name = $("#name").val();
    let phone = $("#phone").val();
    let products = $("#products").val();
    let total = $("#total").val();
    let address = $("#address").val();
    $.ajax({
      url: "place_order.php",
      method: "POST",
      data: {
        name,
        phone,
        products,
        total,
        address,
      },
      success: (response) => {
        $("#message").html(response);
      },
    });
  });

  //le nombre de produits dans la panier
  function numberOfProductsInCart() {
    $.ajax({
      url: "cart_count.php",
      success: (response) => {
        $("#cart").text(response);
      },
    });
  }
  numberOfProductsInCart();
});
