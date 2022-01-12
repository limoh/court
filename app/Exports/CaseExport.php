<?php

namespace App\Exports;

use App\Models\Kesi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CaseExport implements FromQuery, WithHeadings
{
	use Exportable;

	private $columns = ['title', 'description', 'filedate', 'p_name', 'judge_id', 'lawyer_id', 'first_hearing', 'next_hearing', 'd_name'];

	public function query()
	{
		return Kesi::query()
		->select($this->columns);

	}

	public function headings(): array 
	{
		return $this->columns;
	}
}