<?php

use function Livewire\Volt\{state, layout, title};

layout('components.layouts.office');
title('Halaman Tabel Survey Masuk');

?>

<section class="mx-auto">

  <livewire:PowerGrid.Office.SurveyPelangganTabel />

</section>
