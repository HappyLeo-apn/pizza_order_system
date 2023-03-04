$(document).ready(function () {
  $("#sortOption").change(function () {
    $eventOption = $("#sortOption").val();
    if ($eventOption == "asc") {
      $.ajax({
        type: "get",
        data: {
          status: "asc",
          message: "Testing message",
        },
        url: "/user/ajax/pizza/List",
        dataType: "json",
        success: function(response){
          $list = " ";
          console.log(response);
          for ($i = 0; $i < response.length; $i++) {
            $list += `  
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden text-center rounded">
                                <img class="img-fluid mb-1 rounded" style="width:356px;height: 270px"
                                    src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                  
                                <div class="product-action bg-dark py-2 rounded">
                                    <a class="btn btn-outline-light btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-light btn-square"
                                        href="{{ route('user#pizzaDetails', ${response[$i].id}) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href=""> ${response[$i].name} </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> ${response[$i].price}  kyats</h5>
                                    <h6 class="text-muted ml-2"></h6>
                                </div>

                            </div>
                        </div>
                    </div>
            `;
            
           
           
          }
          $("#dataList").html($list);
          
        },
      });
    } else if ($eventOption == "desc") {
      $.ajax({
        type: "get",
        data: {
          status: "desc",
        },
        url: "/user/ajax/pizza/List",
        dataType: "json",
        success: function (response) {
          $list = " ";
          for ($i = 0; $i < response.length; $i++) {
            $list += `
           
            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden text-center rounded">
                                <img class="img-fluid mb-1 rounded" style="width:356px;height: 270px"
                                    src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action bg-dark py-2 rounded">
                                    <a class="btn btn-outline-light btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-light btn-square"
                                        href="{{ route('user#pizzaDetails', ${response[$i].id}) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href=""> ${response[$i].name} </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> ${response[$i].price}  kyats</h5>
                                    <h6 class="text-muted ml-2"></h6>
                                </div>
                               
                            </div>
                        </div>
                    </div>
            `;
           
           
          }
          $("#dataList").html($list);
        },
      });
    }
  });
});
