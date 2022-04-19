 <?php
require_once('connection/conf.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>
<body>
  <form action="" method="POST">
        <input type="time" name="datetime1" id="datetime1">
        <input type="datetime" name="datetime2" id="datetime2">
        <button type="submit"name="submit">submit</button>
        </form>
    <?php
    // $hash = '$2a$10$eBk3rnWsCy5mwtRrwodGY.gsK5WMmT1AkegBMCmpGhYtnPaBd4O8u';
    // $valid = password_verify('123',$hash);

    // echo $valid ? 'valid': 'not valid';

    
    ?>
</body>
</html>

<!--
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Alpine.js Example - Modal</title>
    <link rel="stylesheet" href="public/css/output.css">
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<script src="assets/sweetalert/sweetalert2.min.js"></script>
	<style>
		
	</style>


</head>

<body class="mx-auto w-full bg-gray-100 flex items-center justify-center h-screen" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>



	<section class="flex p-4 h-full items-center">

		<button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="showModal = true">Open modal</button>

	Overlay
		<div class="" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-30 flex': showModal }">
			<Dialog
			<div class="bg-gray-800 absolute transform transition duration-600 inset-y-0 right-0 rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

			Title
				<div class="flex justify-between bg-gray-800 pb-3 ">
					<p class="text-xl font-bold text-gray-600">Form Laporan</p>
					<div class="cursor-pointer z-50 bg-gray-600 p-2 rounded-full hover:bg-opacity-50" @click="showModal = false">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
				</div>
					
				</div>

		content 
				<form action="" class="">
					<div class="w-full mb-2">
                        <div class="flex items-center ">
                            <input type="email" name="email" class="px-8 w-full py-2 text-zinc-400 
							border-[0.5px] border-opacity-60 rounded-full focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" placeholder="Masukan Email anda" required>       
                    </div>

				</form>

				FooteR
				<div class="flex justify-end pt-2">
					<button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" @click="alert('Additional Action');">Action</button>
					<button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" @click="showModal = false">Close</button>
				</div>


			</div>
			</Dialog
		</div>/Overlay

	</section>
	<button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('small-modal-id')">
  Open small modal
</button>
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="small-modal-id">
  <div class="relative w-auto my-6 mx-auto max-w-sm">
    <content
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
     header
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h3 class="text-3xl font-semibold">
          Modal Title
        </h3>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('small-modal-id')">
          <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      body
      <div class="relative p-6 flex-auto">
        <p class="my-4 text-blueGray-500 text-lg leading-relaxed">
          I always felt like I could do anything. That’s the main
          thing people are controlled by! Thoughts- their perception
          of themselves! They're slowed down by their perception of
          themselves. If you're taught you can’t do anything, you
          won’t do anything. I was taught I could do everything.
        </p>
      </div>
      footer
      <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('small-modal-id')">
          Close
        </button>
        <button class="bg-blue-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('small-modal-id')">
          Save Changes
        </button>
      </div>
    </div>
  </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="small-modal-id-backdrop"></div>
<script type="text/javascript">
  function toggleModal(modalID){
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");
  }
</script>

/* 
date_default_timezone_set("Asia/Jakarta");
echo date('G');
$time = localtime(time(), true);
$tanggal = date('Y-m-d');
$Hari = date('l');
if($time['tm_hour'] > 7) {
    echo"Maaf Anda telat"."\n";
}

echo date('l M Y') ."\n";

$insert = "INSERT INTO tbl_absensi_siswa(tanggal,Hari,nis,nama,kelas,status,poin) VALUES($tanggal,$Hari,20208878,'SARAGIH','XII TEL 1','TERLAMBAT',20)";

mysqli_query($confg,$insert);
?>
*/
</body> 

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="jquery.signature/jquery.signature.css" rel="stylesheet">
<style>
 #signature,#prev{
 width: 300px;
 height: 200px;
 }
</style>
