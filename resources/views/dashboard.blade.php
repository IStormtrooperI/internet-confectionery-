<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный кабинет') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Вы успешно авторизованы!
                    @if(session()->exists('was_updated'))
                        {{session('was_updated')}}
                    @endif
                    <div>
                        <img src="{{asset($user->avatar)}}" alt="Ваша аватарка">
                        <form action="{{route('updateProfileUser')}}" method="POST" enctype="multipart/form-data">
                            <input type="file" name="avatarFile">
                            <input type="text" value="{{$user->name}}" name="name">
                            <select name="gender" value="{{$user->gender}}">
                                @if($user->gender == null)
                                    <option disabled selected></option>
                                @endif
                                <option @if($user->gender == 'M') selected @endif value="M">Мужской</option>
                                <option @if($user->gender == 'F') selected @endif value="F">Женский</option>
                            </select>
                            <input type="date" value="{{$user->birthday}}" name="birthday">
                            <input type="text" value="{{$user->phone}}" name="phone">
                            <input type="text" value="{{$user->from}}" name="from">
                            <button type="submit">Изменить данные</button>
                            {{ csrf_field() }}
                            {{$user}}
                        </form>

                        @if(count($errors)>0)
                            <div class="error" style="color:red">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>

                    <div>
                        Ваш статус - {{ $userStatus->name }}
                    </div>
                    <div>
                        Бонусов - {{ $user->bonus }}
                    </div>

                    <div>
                        @empty($orders)
                            <div>
                                @foreach($orders as $order)
                                    <div>{{$order}}</div>
                                @endforeach
                            </div>
                        @endempty
                        @empty($intervals)
                            <div>
                                @foreach($intervals as $interval)
                                    <div>{{$interval}}</div>
                                @endforeach
                            </div>
                        @endempty
                        @empty($schedule_standards)
                            <div>
                                @foreach($schedule_standards as $schedule_standard)
                                    <div>{{$schedule_standard}}</div>
                                @endforeach
                            </div>
                        @endempty
                        @empty($order_statuses)
                            <div>
                                @foreach($order_statuses as $order_status)
                                    <div>{{$order_status}}</div>
                                @endforeach
                            </div>
                        @endempty
                        @empty($orders_productes)
                            <div>
                                @foreach($orders_productes as $order_productes)
                                    <div>{{$order_productes}}</div>
                                @endforeach
                            </div>
                        @endempty
                        @empty($products)
                            <div>
                                @foreach($products as $product)
                                    <div>{{$product}}</div>
                                @endforeach
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
