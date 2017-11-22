<?php

/* @var $this yii\web\View */

$this->title = 'eStore | jQuery client';
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
$this->registerJsFile('@web/js/miniclient.js');
?>
<div class="site-index">

    <h1>Client</h1>
    <table class='table table-striped table-bordered'>
        <tbody>
            <tr>
                <td style='width: 200px;'>
                    <div class='mc-menu'></div>
                </td>
                <td>
                    <div><input type='text' id='search' /> <a class='btn btn-primary btn-search'>Search</a></div>
                    <div class='mc-content'></div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
