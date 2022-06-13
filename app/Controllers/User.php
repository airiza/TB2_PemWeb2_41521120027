<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

// deklarasi class User memiliki sifat keturuan dari BaseController
class User extends BaseController
{
    // deklarasi method index(), berfungsi sebagai method index
    public function index()
    {
        // deklarasi variable user, untuk memanggil model user
        $user = model("User");
        // return halaman UserView dengan variable data berisi hasil dari pemanggilan method findAll() dari model user
        return view('UserView', [
            'data' => $user->findAll()
        ]);
    }

    // deklarasi method Search() untuk mencari data User berdasarkan username petugas
    public function Search()
    {
        // seperti biasa kita panggil model user disini, dan di deklarasikan sebagai variable user
        $user = model("User");
        // deklaraasi kondisi jika parameter get index search ada dan tidak sama dengan string kosong, 
        if($this->request->getVar('search') && $this->request->getVar('search') != ''){
            // maka query akan ditambah dengan where username_petugas sama dengan variable get index search
            $user = $user->where('username_petugas', $this->request->getVar('search'));
        }
        // memanggil fungsi find() yang artinya hasil dari query memungkinkan ada banyak data
        $user = $user->find();
        
        // return halaman UserView dengan variable data berisi user dengan kategori username_petugas sama dengan variable get index search 
        return view('UserView', [
            'data' => $user
        ]);
    }

    // deklarasi method Tambah(), method ini akan berfungsi untuk menambah data buku
    public function Tambah()
    {
        // return halaman TambahUser dengan data action berisi link url / tujuan kemana form TambahUser akan di kirim. 
        // '/User/DoTambahUser' artinya form akan disubmit ke controller User dan fungsi DoTambahUser() yang akan dijelaskan setelah fungsi ini (Tambah())
        return view('TambahUser', [
            'action' => base_url().'/User/DoTambahUser'
        ]);
    }

    // deklarasi method DoTambahUser(), berfungsi sebagai action yang akan kita lakukan pada saat mensubmit form tambah user
    public function DoTambahUser()
    {
        // variable data berisikan parameter-parameter yang ada di form user yang terkirim ke method ini
        $data = $this->request->getPost();
        // seperti biasa kita panggil model user disini, dan di deklarasikan sebagai variable user
        $user = model("User");

        // kondisi jika username_petugas blm ada di dalam database, maka program akan insert, jika sudah tidak akan insert apapun
        if(!$user->where('username_petugas', $this->request->getVar('username_petugas'))->find()) {
            $encrypter = \Config\Services::encrypter();
            $ciphertext = bin2hex($encrypter->encrypt($data['password_petugas']));

            $data['password_petugas'] = $ciphertext; 
            // var_dump($data);
            $user->insert($data);
        }

        // saat semua proses selesai, redirect ke menu list user
        return redirect()->to(base_url('User'));
    }

    // deklarasi method HapusUser(), berfungsi untuk menghapus user berdasarkan id petugas
    public function HapusUser($id)
    {
        // seperti biasa kita panggil model user disini, dan di deklarasikan sebagai variable user
        $user = model("User");
        // cari User dengan id_petugas sama dengan variable id, dan langsung menghapusnya jika menemukan data
        $user->where('id_petugas', $id)->delete();
        // saat semua proses selesai, redirect ke menu list user
        return redirect()->to(base_url('User'));
    }

    // deklarasi method EditUser(), berfungsi untuk menampilkan halaman form edit user berserta data2 user yang dipilih untuk diedit
    public function EditUser($id)
    {
        // seperti biasa kita panggil model user disini, dan di deklarasikan sebagai variable user
        $user = model("User");
        // cari User dengan id_petugas sama dengan variable id, yang nantinya akan ditampilkan pada view TambahUser
        $user = $user->where('id_petugas', $id)->first();

        // tampilkan halaman / view TambahUser dengan data $user yang dipilih, dan data action berisi url kemana form TambahUser akan dikirim
        // jika diperhatikan kita sengaja menggunakan view TambahUser sebagai edit dan add sekaligus agar hemat resource, yang jadi pembeda adalah actionnya kemana data form tersebut akan dikirim yaitu pada data action
        return view('TambahUser', [
            'dataUser' => $user,
            'action' => base_url().'/User/DoEdit/'.$id
        ]);
    }

    // deklarasi method DoTambahUser(), berfungsi sebagai action yang akan kita lakukan pada saat mensubmit form edit user dikirim
    public function DoEdit($id)
    {
        // variable data berisikan parameter-parameter yang ada di form user yang terkirim ke method ini
        $data = $this->request->getPost();
        // seperti biasa kita panggil model user disini, dan di deklarasikan sebagai variable user
        $user = model("User");
        // cari User dengan id_petugas sama dengan variable id, dan langsung menghapusnya jika menemukan data
        $user = $user->where('id_petugas', $id);
        //Encrypt password
        $encrypter = \Config\Services::encrypter();
        $ciphertext = bin2hex($encrypter->encrypt($data['password_petugas']));
        $data['password_petugas'] = $ciphertext; 
        // update data yang ditemukan dengan parameter form 
        $user->update($id, $data);
        // saat semua proses selesai, redirect ke menu list user
        return redirect()->to(base_url('User'));
    }
	
	// deklarasi method Detail(), method ini akan berfungsi untuk detail data user
    public function Detail($id)
    {
        // seperti biasa kita panggil model user disini, dan di deklarasikan sebagai variable user
        $user = model("User");
        // cari User dengan id_petugas sama dengan variable id, yang nantinya akan ditampilkan pada view TambahUser
        $user = $user->where('id_petugas', $id)->first();

        // tampilkan halaman / view TambahUser dengan data $user yang dipilih, dan data action berisi url kemana form TambahUser akan dikirim
        // jika diperhatikan kita sengaja menggunakan view TambahUser sebagai edit dan add sekaligus agar hemat resource, yang jadi pembeda adalah actionnya kemana data form tersebut akan dikirim yaitu pada data action
        return view('DetailUser', [
            'dataUser' => $user,
        ]);
    }
	
	public function generatePDF()
    {
        $filename = date('y-m-d-H-i-s').'Data User';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
		$user = model("User");
        //echo json_encode($data);
		//exit();
        // load HTML content
        $dompdf->loadHtml(view('export/UserViewPdf',['data' => $user->findAll()]));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
	
	public function generateExcel()
	{
		
		$user = model("User");
		$user = $user->findAll();
		
		
		$spreadsheet = new Spreadsheet();
		
		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'List Data User');
		// tulis header/nama kolom 
		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A3', 'Nama')
					->setCellValue('B3', 'Username')
					->setCellValue('C3', 'Jabatan')
					->setCellValue('D3', 'Alamat')
					->setCellValue('E3', 'No Telp');
		
		$column = 4;
		// tulis data mobil ke cell
		foreach($user as $data => $value) {
			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $column, $value->nama_petugas)
						->setCellValue('B' . $column, $value->username_petugas)
						->setCellValue('C' . $column, $value->jabatan_petugas)
						->setCellValue('D' . $column, $value->alamat_petugas)
						->setCellValue('E' . $column, $value->no_telp_petugas);
			$column++;
		}
		
		$spreadsheet
			->getActiveSheet()
			->getStyle('A3:E'.$column)
			->getBorders()
			->getAllBorders()
			->setBorderStyle(Border::BORDER_THIN)
			->setColor(new Color('black'));
		$spreadsheet
			->getActiveSheet()
			->getStyle('A3:E'.$column)
			->getBorders()
			->getOutline()
			->setBorderStyle(Border::BORDER_THICK)
			->setColor(new Color('black'));
		// tulis dalam format .xlsx
		$writer = new Xlsx($spreadsheet);
		$fileName = date('y-m-d-H-i-s').'Data User';

		// Redirect hasil generate xlsx ke web client
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	
	
	}	

}
