$(function(){
    var $menuUrl = '/api/category-list',
        $categoryUrl = '/api/category',
        $productUrl = '/api/product',
        $defaultImage = '/images/product/no_image.png',
        $currentCategory = 0,
        $currentPage = 1;
    $('.mc-menu').append('<p>Loading...</p>');

    showMenu();
    showContentList();
    $('.btn-search').on('click', function(){
        $currentPage = 1;
        showContentList();
    });

    function showCategory()
    {
        $currentCategory = $(this).data('id');
        $currentPage = 1;
        $('.btn-category').removeClass('btn-success');
        $('.category-'+$currentCategory).addClass('btn-success');
        showContentList();
    }

    function changePage()
    {
        $currentPage = $(this).data('page');
        showContentList();
    }

    function showContentList()
    {
        $urlParams = '?category=' + $currentCategory + '&page=' + $currentPage;
        if ($('#search').val())
        {
            $urlParams += '&search=' + $('#search').val();
        }
        $.ajax({
            'url': $categoryUrl + $urlParams,
            'dataType': 'json',
            'success': function(response) {
                $('.mc-content').html('');
                $('.mc-content').append(
                    '<table class="table table-content table-striped table-bordered">'
                    + '<tbody>'
                );
                if (response.total != 0)
                {
                    if (response.pages > 1)
                    {
                        $('.table-content').append(
                            '<tr>'
                            + '<td colspan="3"><ul class="pagination"></ul></td>'
                            + '</tr>'
                        );
                        for ($page = 1; $page <= response.pages; $page++)
                        {
                            $class = '';
                            if ($currentPage == $page)
                            {
                                $class = ' class="active"';
                            }
                            $('.pagination').append(
                                '<li' + $class + '>'
                                + '<a data-page="' + $page + '">' + $page + '</a>'
                                + '</li>'
                            );
                        }
                        $('.pagination a').on('click', changePage);
                    }
                    $.each(response.products, function(i, e) {
                        $img = $defaultImage;
                        if (e.image != null)
                        {
                            $img = e.image;
                        }
                        $('.table-content').append(
                            '<tr>'
                            + '<td><img src="' + $img + '" style="height: 64px;" /></td>'
                            + '<td><a class="product-' + i + '" data-id="' + i + '">' + e.title + '</a></td>'
                            + '<td>' + e.vendor + '</td>'
                            + '</tr>'
                        );
                        $('.product-' + i).on('click', showProduct);
                    });
                }
                else
                {
                    $('.table-content').append(
                        '<tr>'
                        + '<th>'
                        + 'No Products Found!'
                        + '</th>'
                        + '</tr>'
                    );
                }
                $('.mc-content').append(
                    '</tbody>'
                    + '</table>'
                );
            },
        });
    }

    function showProduct()
    {
        $('.mc-content').html('');
        $.ajax({
            'url': $productUrl + '?product=' + $(this).data('id'),
            'dataType': 'json',
            'success': function(response) {
                $('.mc-content').append(
                    '<table class="table table-content table-striped table-bordered">'
                    + '<tbody>'
                );
                if (response.error == 1) 
                {
                    $('.table-content').append(
                        '<tr>'
                        + '<td colspan="2">Product Not Found!</td>'
                        + '</tr>'
                    );
                }
                else
                {
                    $img = $defaultImage;
                    if (response.image != null)
                    {
                        $img = response.image;
                    }
                    $('.table-content').append(
                        '<tr>'
                        + '<th>Product Name: </th>'
                        + '<td>' + response.title + '</td>'
                        + '</tr>'
                    );
                    $('.table-content').append(
                        '<tr>'
                        + '<th>Product Image: </th>'
                        + '<td><img src="' + $img + '" style="height: 64px;" /></td>'
                        + '</tr>'
                    );
                    $('.table-content').append(
                        '<tr>'
                        + '<th>Product Categories: </th>'
                        + '<td>' + response.categories + '</td>'
                        + '</tr>'
                    );
                    $('.table-content').append(
                        '<tr>'
                        + '<th>Product Vendor: </th>'
                        + '<td>' + response.vendor + '</td>'
                        + '</tr>'
                    );
                    $('.table-content').append(
                        '<tr>'
                        + '<th>Product Description: </th>'
                        + '<td>' + response.desc + '</td>'
                        + '</tr>'
                    );
                }
                $('.table-content').append(
                    '<tr>'
                    + '<th></th>'
                    + '<td><a class="btn btn-primary btn-back">Back</a></td>'
                    + '</tr>'
                );
                $('.mc-content').append(
                    '</tbody>'
                    + '</table>'
                );
                $('.btn-back').on('click', showContentList);
            },
        });
        
    }

    function showMenu()
    {
        $urlParams = '';
        if ($('#search').val())
        {
            $urlParams = '?search=' + $('#search').val();
        }
        $.ajax({
            'url': $menuUrl+$urlParams,
            'dataType': 'json',
            'success': function(response) {
                $('.mc-menu').html('');
                $('.mc-menu').append(
                    '<div>'
                    + '<a style="width: 100%;" class="btn btn-primary btn-success btn-category category-0" data-id="0" >'
                    + 'All Categories'
                    + '</a>'
                    + '</div>'
                );
                $('.category-0').on('click', showCategory);
                $.each(response.categories, function(i, e){
                    $('.mc-menu').append(
                        '<div>'
                        + '<a style="width: 100%;" class="btn btn-primary btn-category category-' + i + '" data-id="' + i + '" >'
                        + e.category
                        + '</a>'
                        + '</div>'
                    );
                    $('.category-' + i).on('click', showCategory);
                });
            },
            'error': function() {
                $('.mc-menu').append('<p>Couldn\'t receive category list!');
            }
        });
    }
});