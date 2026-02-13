<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;

    public function __construct(string $variant = 'primary')
    {
        $this->variant = $variant;
    }

    public function render()
    {
        return view('components.button');
    }
}

?>

// resources/views/components/button.blade.php

<div class="btn btn-{{ $variant }}"><?php echo $slot; ?></div>

<style>
    .btn { padding: 10px 20px; border: none; border-radius: 5px; color: white; }
    .btn-primary { background-color: blue; }
    .btn-secondary { background-color: gray; }
    .btn-danger { background-color: red; }
    .btn-success { background-color: green; }
</style>