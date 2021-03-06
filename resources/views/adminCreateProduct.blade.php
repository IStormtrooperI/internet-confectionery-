<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-right: -160px;">
            {{ __('Добавление ассортимента') }}
        </h2>
        @if(session()->exists('was_updated'))
            <div
                style="padding: 0 10px; margin-left:auto; text-align: center; background-color: #9df99d; border-radius: 10px;">{{session('was_updated')}}
            </div>
        @endif
    </x-slot>
    <div style="padding: 15px;">
        <div style="float: left; width: 30%; text-align: center; padding: 10px;">
            <h3 style="font-size: 1.17rem;">Добавление</h3>
            <div style="border: 1px solid black; padding: 5px; margin: 10px 0; background-color:  #ffbeb5;" class="main_cursor_hover hundredWidth" onclick="hiddenFormAdd(this, 'div_tort')">
                <h4 style="all:revert; margin: 0; text-align: center;">Продукт</h4>
            </div>
            <div style="border: 1px solid black; padding: 5px; margin: 10px 0; background-color:  #ffbeb5;" class="main_cursor_hover hundredWidth" onclick="hiddenFormAdd(this,'div_type_product')">
                <h4 style="all:revert; margin: 0; text-align: center;">Тип продукта</h4>
            </div>
            <div style="border: 1px solid black; padding: 5px; margin: 10px 0; background-color: #ffbeb5;" class="main_cursor_hover hundredWidth" onclick="hiddenFormAdd(this,'div_comp')">
                <h4 style="all:revert; margin: 0; text-align: center;">Компонент</h4>
            </div>
            <div style="border: 1px solid black; padding: 5px; margin: 10px 0; background-color:  #ffbeb5;" class="main_cursor_hover hundredWidth" onclick="hiddenFormAdd(this,'div_type_comp')">
                <h4 style="all:revert; margin: 0; text-align: center;">Тип компонента</h4>
            </div>
            <div style="border: 1px solid black; padding: 5px; margin: 10px 0; background-color:  #ffbeb5;" class="main_cursor_hover hundredWidth" onclick="hiddenFormAdd(this,'div_ingredient')">
                <h4 style="all:revert; margin: 0; text-align: center;">Ингредиент</h4>
            </div>
            @if(count($errors)>0)
                <div class="error" style="color:red; padding: 20px;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @php
                    $old = array();
                    $old = old();
                @endphp
            @endif
            @if(session()->exists('errorInDB'))
                @php
                    $old_data = session('data');
                @endphp
                <div class="error" style="color:red; padding: 20px;">
                    <ul>
                        <li>{{session('errorInDB')}}</li>
                    </ul>
                </div>
            @endif
            @if(session()->exists('errorWithWeight'))
                @php
                    $old_data = session('data');
                @endphp
                <div class="error" style="color:red; padding: 20px;">
                    <ul>
                        <li>{{session('errorWithWeight')}}</li>
                    </ul>
                </div>
            @endif
            @if(session()->exists('errorWithData'))
                @php
                    $old_data = session('data');
                @endphp
                <div class="error" style="color:red; padding: 20px;">
                    <ul>
                        <li>{{session('errorWithData')}}</li>
                    </ul>
                </div>
            @endif
            @if(session()->exists('was_created'))
                <div
                    style="padding: 0 10px; margin-left:auto; text-align: center; background-color: #9df99d; border-radius: 10px;">{{session('was_created')}}
                </div>
            @endif
        </div>
        <div style="float: right; width: 65%; padding: 10px;">
            {{--      Форма добавления товара      --}}
            <div class="hidden_form" id="div_tort">
                <form action="{{route('adminProductsAddProduct')}}" name="product" method="POST"
                      style="border: 1px solid #6e6e6e; border-radius: 10px; padding: 10px;"
                      enctype="multipart/form-data" class="formAddAdmin">
                    <h2 style="text-align: center; font-size: 20px;">Добавление <span style="text-decoration: underline;">продукта</span></h2>
                    <label for="prod_name">
                        <h3>Название *</h3>
                    </label>
                    <input type="text" name="title" id="prod_name">
                    <label for="prod_descr">
                        <h3>Описание</h3>
                    </label>
                    <textarea type="text" name="description" id="prod_descr">

                    </textarea>
                    <label for="prod_img">
                        <h3>Фото</h3>
                    </label>
                    <input type="file" name="img" id="prod_img">
                    <label for="prod_price">
                        <h3>Стоимость *</h3>
                    </label>
                    <input type="number" name="price" id="prod_price">
                    <label for="prod_coef">
                        <h3>Коэффициент бонусов</h3>
                    </label>
                    <input type="number" name="bonus" id="prod_coef">
                    <label for="type_prod">
                        <h3>Тип продукта *</h3>
                    </label>
                    <select type="number" name="type_prod" id="type_prod" onchange="makeFormForAddProduct(this.value)">
                        <option value="" disabled selected style="display: none;">Выберете значение</option>
                        @foreach($data['product_types'] as $type)
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                        @endforeach
                    </select>
                    <div id="containerAddFormProduct">

                    </div>
                    <div style="text-align: center; margin: 20px auto 0 auto;">
                        <button type="submit" style="text-decoration: underline;">Добавить</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            {{--      Форма добавления типа продукта       --}}
            <div style="" class="hidden_form" id="div_type_product">
                <form action="{{route('adminProductsAddProductType')}}" name="type_product" method="POST"
                      style="border: 1px solid #6e6e6e; border-radius: 10px; padding: 10px;"
                      enctype="multipart/form-data" class="formAddAdmin">
                    <h2 style="text-align: center; font-size: 20px;">Добавление <span style="text-decoration: underline;">типа продукта</span></h2>
                    <label for="type_prod_name">
                        <h3>Название типа продукта *</h3>
                    </label>
                    <input type="text" name="title_type_prod" id="type_prod_name">
                    <label for="type_prod_min_weight">
                        <h3>Минимальный вес(кг)</h3>
                    </label>
                    <input type="number" name="type_prod_min_weight" id="type_prod_min_weight">
                    <label for="type_prod_max_weight">
                        <h3>Максимальный вес(кг)</h3>
                    </label>
                    <input type="number" name="type_prod_max_weight" id="type_prod_max_weight">
                    <label for="type_prod_standard_weight">
                        <h3>Стандартный вес(кг) *</h3>
                    </label>
                    <input type="number" name="type_prod_standard_weight" id="type_prod_standard_weight">
                    <label for="using_constr">
                        <h3>Используется в конструкторе? *</h3>
                    </label>
                    <input type="checkbox" name="using_constr" id="using_constr" style="width: 16px;">
                    <div style="text-align: center; margin: 20px auto 0 auto;">
                        <button type="submit" style="text-decoration: underline;">Добавить</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            {{--      Форма добавления компонента      --}}
            <div style="" class="hidden_form" id="div_comp">
                <form action="{{route('adminProductsAddComponent')}}" name="component" method="POST"
                      style="border: 1px solid #6e6e6e; border-radius: 10px; padding: 10px;"
                      enctype="multipart/form-data" class="formAddAdmin">
                    <h2 style="text-align: center; font-size: 20px;">Добавление <span style="text-decoration: underline;">компонента</span></h2>
                    <label for="comp_name">
                        <h3>Название *</h3>
                    </label>
                    <input type="text" name="comp_name" id="comp_name">
                    <label for="comp_descr">
                        <h3>Описание</h3>
                    </label>
                    <textarea type="text" name="comp_description" id="comp_descr"></textarea>
                    <label for="comp_type_comp">
                        <h3>К какому типу компонента относится *</h3>
                    </label>
                    <select type="number" name="comp_type_comp" id="comp_prod_type_comp">
                        <option value="" disabled selected style="display: none;">Выберете значение</option>
                        @foreach($data['component_types'] as $type)
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                        @endforeach
                    </select>
                    <label for="comp_type_prod">
                        <h3>К какому типу продукта относится *</h3>
                    </label>
                    <select type="number" name="comp_type_prod" id="comp_prod_type_prod">
                        <option value="" disabled selected style="display: none;">Выберете значение</option>
                        @foreach($data['product_types'] as $type)
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                        @endforeach
                    </select>
                    <label for="comp_img">
                        <h3>Фото</h3>
                    </label>
                    <input type="file" name="comp" id="comp_img">
                    <label for="comp_price">
                        <h3>Стоимость *</h3>
                    </label>
                    <input type="number" name="comp_price" id="comp_price">
                    <label for="comp_coef">
                        <h3>Вес данного компонента на кг изделия(кг) *</h3>
                    </label>
                    <input type="number" name="comp_coef" id="comp_coef">


                    <div class="ingredient" style="text-align: center; border: 1px solid black; padding: 10px; border-radius: 5px;">
                        <label for="comp_ingred">
                            <h3 class="label_for_ingredient">Ингредиент 1 *</h3>
                        </label>
                        <select type="number" name="comp_ingred_0" id="comp_ingred" class="selectsOfIngrid">
                            <option value="" disabled selected style="display: none;">Выберете значение</option>
                            @foreach($data['ingredients'] as $ingredient)
                                <option value="{{$ingredient['id']}}">{{$ingredient['name']}}</option>
                            @endforeach
                        </select>
                        <label for="comp_ingred_weight">
                            <h3>Доля ингредиента в компоненте (0 - 1) *</h3>
                        </label>
                        <input type="number" name="comp_ingred_weight_0" id="comp_ingred_weight" class="inputsOfIngrid">
                    </div>

                    <div id='addButton' style="text-align: center; margin: 20px auto 0 auto;">
                        <button type="button" style="" onclick="addIngredient()">Добавить дополнительный ингредиент</button>
                    </div>
                    <div style="text-align: center; margin: 20px auto 0 auto;">
                        <button type="submit" style="text-decoration: underline;">Добавить</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            {{--      Форма добавления типа компонента      --}}
            <div style="" class="hidden_form" id="div_type_comp">
                <form action="{{route('adminProductsAddComponentType')}}" name="type_component" method="POST"
                      style="border: 1px solid #6e6e6e; border-radius: 10px; padding: 10px;"
                      enctype="multipart/form-data" class="formAddAdmin">
                    <h2 style="text-align: center; font-size: 20px;">Добавление <span style="text-decoration: underline;">типа компонента</span></h2>
                    <label for="type_comp_name">
                        <h3>Название типа компонента *</h3>
                    </label>
                    <input type="text" name="title_comp_prod" id="type_comp_name">
                    <label for="type_comp_description_for_confectioner">
                        <h3>Описание для кондитера</h3>
                    </label>
                    <input type="text" name="type_comp_description_for_confectioner" id="type_comp_description_for_confectioner">
                    <div style="text-align: center; margin: 20px auto 0 auto;">
                        <button type="submit" style="text-decoration: underline;">Добавить</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            {{--      Форма добавления ингредиента      --}}
            <div style="" class="hidden_form" id="div_ingredient">
                <form action="{{route('adminProductsAddIngredient')}}" name="ingredient" method="POST"
                      style="border: 1px solid #6e6e6e; border-radius: 10px; padding: 10px;"
                      enctype="multipart/form-data" class="formAddAdmin">
                    <h2 style="text-align: center; font-size: 20px;">Добавление <span style="text-decoration: underline;">ингредиента</span></h2>
                    <label for="ingredient_name">
                        <h3>Название типа компонента *</h3>
                    </label>
                    <input type="text" name="title_ingredient" id="ingredient_name">
                    <label for="ingredient_description">
                        <h3>Описание для кондитера</h3>
                    </label>
                    <input type="text" name="ingredient_description" id="ingredient_description">
                    <div style="text-align: center; margin: 20px auto 0 auto;">
                        <button type="submit" style="text-decoration: underline;">Добавить</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let dataJS = @json($data);
    console.log(dataJS);
    function makeFormForAddProduct(id) {
        let htmlIn = '';
            for(var key in dataJS['product_types'][id]['components']){
                htmlIn += '<label for="prod_component_'+key+'"><h3>'+key+' *</h3></label><select type="number" name="component_'+dataJS['product_types'][id]['components'][key][0]['id_component_type']+'" id="prod_component_'+key+'"><option value="" disabled selected style="display: none;">Выберете значение</option>'
                for(var compsKey in dataJS['product_types'][id]['components'][key]){
                    htmlIn += '<option value="'+dataJS['product_types'][id]['components'][key][compsKey]['id']+'">'+dataJS['product_types'][id]['components'][key][compsKey]['name']+'</option>'
                }
                htmlIn += '</select>'
            }
        document.getElementById('containerAddFormProduct').innerHTML = htmlIn;
    }

    function hiddenFormAdd(but, id){
        for(let i = 0; i < document.getElementsByClassName('hidden_form').length; i++){
            document.getElementsByClassName('main_cursor_hover')[i].style.backgroundColor = '#ffbeb5';
            document.getElementsByClassName('hidden_form')[i].style.display = 'none';
        }
        but.style.backgroundColor = 'rgb(222 151 163)';
        document.getElementById(id).style.display = 'block';
    }

    function addIngredient() {
        let ingredients = document.getElementsByClassName('ingredient').length;
        document.getElementById('addButton').insertAdjacentHTML('beforebegin', '<div class="ingredient" style="text-align: center; border: 1px solid black; padding: 10px; border-radius: 5px;">'
            +'<label for="comp_ingred">'
            +'<h3 class="label_for_ingredient">Ингредиент '+(ingredients-(-1))+' *</h3>'
            +'</label>'
            +'<select type="number" name="comp_ingred_'+ingredients+'" id="comp_ingred" class="selectsOfIngrid">'
            +'<option value="" disabled selected style="display: none;">Выберете значение</option>'
            @foreach($data['ingredients'] as $ingredient)
            +'<option value="{{$ingredient['id']}}">{{$ingredient['name']}}</option>'
            @endforeach
            +'</select>'
        +'<label for="comp_ingred_weight">'
            +'<h3>Доля ингредиента в компоненте (0 - 1) *</h3>'
        +'</label>'
        +'<input type="number" name="comp_ingred_weight_'+ingredients+'" id="comp_ingred_weight" class="inputsOfIngrid">'
            +'<button class="deleteButton" type="button" style="" onclick="removeIngredient('+ingredients+')">Удалить ингредиент</button>'
        +'</div>');
    }

    function removeIngredient(id) {
        let ingredients = document.getElementsByClassName('ingredient');
        let labels = document.getElementsByClassName('label_for_ingredient');
        let buttons = document.getElementsByClassName('deleteButton');
        let selects = document.getElementsByClassName('selectsOfIngrid');
        let inputs = document.getElementsByClassName('inputsOfIngrid');
        for(let i = ingredients.length - 1 ; i > id; i--){
            labels[i].innerHTML = labels[i-1].innerHTML;
            buttons[i-1].setAttribute('onclick', buttons[i-2].getAttribute('onclick'))
            selects[i].name = selects[i-1].name
            inputs[i].name = inputs[i-1].name
        }
        ingredients[id].remove();
    }

    window.onload = document.getElementsByClassName('main_cursor_hover')[0].click();
</script>
