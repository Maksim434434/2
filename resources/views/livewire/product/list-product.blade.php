<div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-col text-center w-full">
                <h2 class="sm:text-2xl text-xl font-medium title-font mb-4 text-gray-900">Список товаров</h2>

                <div class="flex justify-between mb-4">
                    <input wire:model.live.debounce.300ms="search"
                           type="text"
                           placeholder="Поиск..."
                           class="border border-gray-300 p-2 rounded">
                </div>

                <div class="flex justify-between mb-4">
                    <div class="flex space-x-2">
                        <select wire:model.live="category_id" class="border border-gray-300 p-2 rounded">
                            <option value="">Все категории</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="country_id" class="border border-gray-300 p-2 rounded">
                            <option value="">Все страны</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button wire:click="resetFilters" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Сбросить фильтры
                    </button>
                </div>

                @if ($products->isEmpty())
                    <div class="py-4 text-center text-gray-500">
                        Товары не найдены
                    </div>
                @else
                    @php
                        $fields = ['ID', 'Название', 'Цена', 'Кол-во', 'Категория', 'Страна', 'Удалить'];
                    @endphp

                    <table class="w-full">
                        <thead>
                            <tr class="grid grid-cols-[1fr_3fr_1fr_1fr_2fr_2fr_1fr] justify-items-start p-2 bg-gray-100">
                                @foreach ($fields as $key => $field)
                                    @if ($field !== 'Удалить')
                                        @php
                                            $sortFieldMap = [
                                                'ID' => 'id',
                                                'Название' => 'name',
                                                'Цена' => 'price',
                                                'Кол-во' => 'count',
                                                'Категория' => 'category_id',
                                                'Страна' => 'country_id'
                                            ];
                                        @endphp
                                        <th wire:click='sortBy("{{ $sortFieldMap[$field] ?? strtolower($field) }}")' class="cursor-pointer" wire:key='{{ $key }}'>
                                            <div class="flex items-center">
                                                {{ $field }}
                                                @if ($sortField === ($sortFieldMap[$field] ?? strtolower($field)))
                                                    <span class="ml-1">
                                                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </th>
                                    @else
                                        <th>{{ $field }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="grid grid-cols-[1fr_3fr_1fr_1fr_2fr_2fr_1fr] justify-items-start items-center p-2 odd:bg-white even:bg-gray-50"
                                    wire:key="{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td class="truncate">{{ $product->name }}</td>
                                    <td class="font-medium text-gray-800">{{ number_format($product->price, 0, '', ' ') }} ₽</td>
                                    <td>{{ $product->count }}</td>
                                    <td>{{ $product->category?->name ?? 'Нет' }}</td>
                                    <td>{{ $product->country?->name ?? 'Нет' }}</td>
                                    <td>
                                        <button
                                            wire:click="deleteProduct({{ $product->id }})"
                                            onclick="return confirm('Удалить товар {{ $product->name }}?')"
                                            class="inline-flex items-center bg-red-100 border-0 py-1 px-3 focus:outline-none hover:bg-red-400 hover:text-white rounded text-base transition-colors duration-200">
                                            Удалить
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>