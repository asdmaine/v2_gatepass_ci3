<?php
$this->logindata['user'] = $this->session->userdata('auth');
// $temp = $this->session->userdata('auth');

// cek didatabase apakah pst_pnr yang login ada di verifikasi1/verifikasi2/approval1/approval2
$count = $this->m_admin->GetLevel($this->logindata['user']['pst_pnr']);
if($count > 0){
	$this->logindata['level'] = 'verifikator';
}else{
	$this->logindata['level'] = 'biasa';
}




// if ($temp['job_level'] != 'HELPER' && $temp['job_level'] != 'ASSISTANT') {
// 	$this->logindata['level'] = 'verifikator';
// } else {
// 	$this->logindata['level'] = 'biasa';
// }

?>