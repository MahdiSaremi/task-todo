<div class="container mx-auto">
    <div class="p-4 space-y-6">
        <div class="flex items-center gap-4 flex-wrap">
            <h1 class="text-2xl">نوشته های من</h1>
            <div class="flex gap-4 justify-end grow">
                <x-mary-input
                    placeholder="جستجو کنید..."
                    icon="o-magnifying-glass"
                />
                <x-mary-button
                    icon="o-plus"
                    class="btn-primary"
                    @click="my_modal_1.showModal()"
                >
                    ایجاد نوشته جدید
                </x-mary-button>
            </div>
        </div>

        <div class="flex items-center gap-4 flex-wrap">
            <x-mary-select
                :options="[
                    ['id' => null, 'name' => 'انتخاب کاربر'],
                    ...$this->users->map(fn($user) => ['id' => $user->id, 'name' => $user->first_name . ' ' . $user->last_name]),
                ]"
            />
            <div class="flex gap-4 text-xs grow justify-end">
                <span class="flex items-center gap-4">
                    @svg('heroicon-o-adjustments-horizontal', 'size-4')
                    فیلتر بر اساس:
                </span>

                <x-mary-button @class(["btn-ghost btn-sm", "text-primary" => $this->status == 0]) @click="$wire.set('status', 0)">
                    همه
                </x-mary-button>
                <x-mary-button @class(["btn-ghost btn-sm", "text-primary" => $this->status == 1]) @click="$wire.set('status', 1)">
                    انجام شده
                </x-mary-button>
                <x-mary-button @class(["btn-ghost btn-sm", "text-primary" => $this->status == 2]) @click="$wire.set('status', 2)">
                    انجام نشده
                </x-mary-button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($this->notes as $note)
                <div class="rounded-xl bg-emerald-400 text-white p-4 flex flex-col gap-4 shadow-lg">
                    <div class="flex items-center gap-2">
                        <span class="text-lg font-bold">{{ $note->title }}</span>
                        <div class="ms-auto"></div>
                        <x-mary-button
                            icon="o-pencil-square"
                            class="btn-square"
                            wire:click="edit"
                        />
                        <x-mary-button
                            icon="o-trash"
                            class="btn-square"
                        />
                    </div>
                    <div class="text-sm text-justify">
                        <p>
                            {{ $note->description }}
                        </p>
                    </div>
                    <div class="mt-auto"></div>
                    <hr class="border-white opacity-50">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-sm">
                            @svg('heroicon-o-document', 'size-4')
                            فایل پیوست
                            ({{ $note->visual_file_size }})
                        </span>
                        <span class="flex items-center gap-2 text-sm">
                            1404/07/07
                            @svg('heroicon-o-calendar', 'size-4')
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <dialog id="my_modal_1" class="modal backdrop-blur-xs">
        <div class="modal-box">
            <h3 class="text-lg font-bold">ایجاد نوشته جدید</h3>
            <x-mary-form wire:submit="create">
                <x-mary-input label="عنوان" wire:model="form.title" />
                <x-mary-datepicker label="تاریخ" wire:model="form.date" />
                <x-mary-radio label="کاربر" wire:model="form.userId" :options="$this->users" option-label="full_name" inline/>
                <x-mary-textarea label="توضیحات" wire:model="form.description" />
                <x-mary-file label="فایل پیوست" wire:model="form.attachment" />
            </x-mary-form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">لغو</button>
                </form>
                <x-mary-form wire:submit="create">
                    <button class="btn btn-primary">تایید و ثبت</button>
                </x-mary-form>
            </div>
        </div>
    </dialog>
</div>
