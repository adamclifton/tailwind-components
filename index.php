<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tailwind Components</title>
</head>
<body>
    <?php
        function componentSelect($type) {
            $path    = 'components/'.$type;
            $types = $files = array_values(array_diff(scandir($path), array('.', '..')));
            foreach ($types as &$each) : ?>
                    <option 
                    <?php if((isset($_POST[$type]) && $each == $_POST[$type])){echo 'selected';}?> 
                    value="<?=$each?>"><?=$each?>
                    </option>
            <?php endforeach;
        };
        function typeSelect(){
            $path = 'components';
            $types = $files = array_values(array_diff(scandir($path), array('.', '..', '.DS_Store')));
            foreach ($types as $each) : ?>
                <option 
                    value="<?=$each?>"><?=$each?>
                </option>
            <?php endforeach;
        };
    ?>
    <div class="flex">
        <div class="w-96 bg-gray-100 h-screen p-12">
            <h1>Components</h1>
            
            <div>
                <form id="componentBuilder" method="post">
                    <label for="heroes" class="block text-sm font-medium text-gray-700 mt-4">Heroes</label>
                    <select id="heroes" name="heroes" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <?php componentSelect(heroes); ?>
                    </select>
                    <label for="headers" class="block text-sm font-medium text-gray-700 mt-4">Headers</label>
                    <select id="headers" name="headers" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <?php componentSelect(headers); ?>
                    </select>
                    <input type="submit" value="Update" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-6">
                </form> 

                <form id="addNewComponent" method="POST" action="save_data.php">
                    <label for="addNew" class="block text-sm font-medium text-gray-700 mt-4">Add New Section</label>
                    <select id="newComponent" name="newComponent" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <?php typeSelect(); ?>
                    </select>
                </form>
                <button onclick="add_field()">Add Component</button>

                <script>
                    function add_field(){
                        
                        var x = document.getElementById("componentBuilder");
                        // create an input field to insert
                        var new_select = document.createElement("select");
                        // set input field data type to text
                        var e = document.getElementById("newComponent");
                        // find the select
                        var text = e.options[e.selectedIndex].text;
                        // get the selected value
                        new_select.setAttribute("name", text);
                        // select last position to insert element before it
                        var pos = x.childElementCount;
                        
                        // insert element
                        x.insertBefore(new_select, x.childNodes[pos]);
                    }
                </script>
            </div>
        </div>
        <div class="w-full">
            <?php 
                $hero = $_POST['heroes'];
                $header = $_POST['headers'];
                include 'components/heroes/'.$hero;
                include 'components/headers/'.$header;
            ?>
        </div>
    </div>
</body>
</html>