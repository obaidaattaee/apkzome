<?php
$message = Session::get("message");
$messageClass = 'alert-info';
?>
@if($message)
    <?php
    $first2Letters = strtolower(substr($message, 0, 2));
    if ($first2Letters == 's:') {
        $messageClass = 'alert-success';
        $message = substr($message, 2);
    } else if ($first2Letters == 'w:') {
        $messageClass = 'alert-warning';
        $message = substr($message, 2);
    } else if ($first2Letters == 'd:') {
        $messageClass = 'alert-danger';
        $message = substr($message, 2);
    }
    ?>
    <div class='alert {{$messageClass}} alert-dismissible mx-6'>
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger  alert-dismissible show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
