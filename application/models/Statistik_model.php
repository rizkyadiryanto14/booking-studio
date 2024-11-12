<?php

/**
 * @property $db
 */

class Statistik_model extends CI_Model
{
	public function get_yearly_revenue($year)
	{
		$this->db->select('MONTH(transaction_time) as month, SUM(gross_amount) as total_revenue');
		$this->db->where('transaction_status', 'success');
		$this->db->where('YEAR(transaction_time)', $year);
		$this->db->group_by('MONTH(transaction_time)');
		$this->db->order_by('MONTH(transaction_time)', 'ASC');
		$query = $this->db->get('laporan_pembayaran');

		$monthly_revenue = array_fill(1, 12, 0);

		foreach ($query->result() as $row) {
			$monthly_revenue[(int)$row->month] = $row->total_revenue;
		}

		return $monthly_revenue;
	}
}
