

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<button class="my_btn">Go</button>
<button class="my_btn2">Rak</button>

<div class="div1">
    <h2>Rakshya</h2>
    <p>I am rakshya aryal</p>
</div>

<div class="div2">
    <h2>Rak</h2>
    <p>I am Rakshya aryal</p>
</div>

<div>
    <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" id="full_name" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="contact">Contact</label>
        <input type="text" name="contact" id="contact" class="form-control"/>
    </div>

    <input type="button" value="Add" id="btn-add" />
</div>
<br/>
<table>
    <thead>
    <tr>
        <td>Full Name</td>
        <td>Contact</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody id="details">
    <tr>
        <td>Rakshya Aryal</td>
        <td>464365445</td>
        <td>
            <button>Delete</button>
        </td>
    </tr>
    <tr>
        <td>Rakshu Aryal</td>
        <td>464365445</td>
        <td>
            <button>Delete</button>
        </td>
    </tr>
    <tr>
        <td>Rak Aryal</td>
        <td>464365445</td>
        <td>
            <button>Delete</button>
        </td>
    </tr>
    <tr>
        <td>Ram Aryal</td>
        <td>464365445</td>
        <td>
            <button>Delete</button>
        </td>
    </tr>
    </tbody>
</table>
<script>

    $(document).ready(function () {

        $('.div2').hide();

        $('.my_btn').click(function () {
            $('.div1').show();
            $('.div2').hide();
        });
        $('.my_btn2').click(function () {
            $('.div1').hide();
            $('.div2').show();
        });

        $("#btn-add").click(function () {
            var full_name = $("#full_name").val();
            var contact = $("#contact").val();

            var new_row = '<tr>' +
                '<td>'+full_name+'</td>' +
                '<td>'+contact+'</td>' +
                '<td><button>Delete</button></td>' +
                '</tr>';


            $("#details").append(new_row);
        });

    });

</script>


