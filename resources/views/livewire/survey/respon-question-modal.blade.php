<div>
  <x-wireui-modal-card blur="xl"
                       name="modalPasien"
                       width="fullscreen"
                       align="center"
                       persistent>
    <x-slot:title>
      <h1 class="mx-auto text-4xl uppercase">Form Data Diri Pasien</h1>
    </x-slot:title>
    <div class="grid grid-cols-1 gap-4">
      <x-wireui-input wire:model="form.namaPasien"
                      icon="user"
                      placeholder="Masukan nama"
                      with-validation-colors
                      rounded
                      padding="p-4">
        <x-slot:label>
          <h2 class="uppercase">Nama Pasien</h2>
        </x-slot:label>
      </x-wireui-input>

      <x-wireui-maskable wire:model="form.nomorPasien"
                         icon="phone"
                         :mask="['0##########', '0###########']"
                         placeholder="+62xxxxxxxxxx"
                         with-validation-colors
                         rounded
                         padding="p-4">
        <x-slot:label>
          <h2 class="uppercase">Nomor Handphone</h2>
        </x-slot:label>
      </x-wireui-maskable>
    </div>

    <x-slot name="footer"
            class="flex justify-between gap-x-4">
      {{-- <div class="shrink">
        <x-wireui-button right-icon="arrow-path"
                         label="Reset Form"
                         secondary
                         wire:click="resetSurvey"
                         class="w-full"
                         rounded />
      </div> --}}
      <div class="grow">

        <x-wireui-button positive
                         label="Simpan"
                         right-icon="paper-airplane"
                         wire:click="simpanSurvey"
                         class="w-full"
                         rounded />
      </div>
    </x-slot>
  </x-wireui-modal-card>
</div>
