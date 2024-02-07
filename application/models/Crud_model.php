<?php
class crud_model extends CI_Model
{

    /*
        |  FOR SELECT ALL DATA = get_all_records, get
        |  FOR SELECT SPECIFIC DATA = get_where, get_where_data
        |  FOR INSERT = save
        |  FOR INSERT with UNICODE = save_nvarchar
        |  FOR UDPATE = update
        |  FOR INSERT with UNICODE = update_nvarchar
        |  FOR DELETE = delete_by_id
        |  FOR EXECUTE CUSTOM QUERY = executeSqlQuery
        |  FOR EXECUTE CUSTOM PARAMETERISED QUERY = execute_param_query
        |  FOR ONLY UPDATE RECORD WITHOUT UPDATED AT AND OTHER TRACKING WITH UNICODE = simpleUpdateNvarchar
        */

    public function add_record($table, $data)
    {
        $this->db->insert($table, $data);
        return true;
    }

    // get_all_records and get both functions are same. Just created for ease of calling.
    public function get_all_records($table, $orderby = null, $extrawhere = null)
    {
        if ($orderby != '') {
            $this->db->order_by($orderby, "asc");
        }
        if ($extrawhere != '') {
            $query = $this->db->get_where($table, $extrawhere);
        } else {
            $query = $this->db->get($table);
        }

        return $result = $query->result_array();
    }

    public function get($table, $orderby = null, $extrawhere = null)
    {

        if ($orderby != '') {
            $this->db->order_by($orderby, "asc");
        }
        if ($extrawhere != '') {

            $query = $this->db->get_where($table, $extrawhere);
        } else {

            $query = $this->db->get($table);
        }

        return $result = $query->result_array();
    }

    public function get_where($table, $searchData = array(), $orderby = null)
    {
        if ($orderby != '' || !empty($orderby)) {
            $orderbyField = array_keys($orderby);
            $orderbyValue = array_values($orderby);
            $query = $this->db->order_by($orderbyField[0], $orderbyValue[0])->get_where($table, $searchData);
        } else {
            $query = $this->db->get_where($table, $searchData);
        }
        return $query->result_array();
    }

    public function get_num_rows($table, $searchData = array())
    {
        $query = $this->db->get_where($table, $searchData);
        return  $query->num_rows();
    }
    public function get_record_by_fieldname($table, $fieldname, $id)
    {
        $query = $this->db->get_where($table, array($fieldname => $id));
        return $result = $query->row_array();
    }
    public function executeSqlQuery($SQL)
    {
        $query = $this->db->query($SQL);
        return $result = $query->result_array();
    }

    public function execute_param_query($SQL, $perams = array())
    {
        $query = $this->db->query($SQL, $perams);
        return $result = $query->result_array();
    }
    public function edit_record($table, $field, $id, $data)
    {
        $this->db->where($field, $id);
        $this->db->update($table, $data);
        return true;
    }
    public function delete_record($table, $field, $id)
    {
        $this->db->delete($table, array($field => $id));
        return true;
    }


    ///////************** AJAX DATATABLE OPETAIONS */

    private function _get_datatables_query($table, $custom_query = null)
    {
        // echo $table;exit();
        $order = array('id' => 'asc');
        $this->db->select('*');
        $this->db->from($table);

        $column = $this->db->list_fields($table);
        $i = 0;
        foreach ($column as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($column) - 1 == $i) { //last loop
                    $this->db->group_end();
                } //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($table, $custom_query = null)
    {
        if ($custom_query == null) {
            $this->_get_datatables_query($table, $custom_query);
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        } else {
            if ($_POST['length'] != -1) {
                $custom_query = $custom_query . " OFFSET " . $_POST['start'] . " ROWS
				 FETCH NEXT  " . $_POST['length'] . " ROWS ONLY;";
            }
            $query = $this->db->query($custom_query);
            return $query->result();
        }
    }

    public function count_filtered($table)
    {
        $this->_get_datatables_query($table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('estu_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_where_data($table, $searchData = array())
    {

        $query = $this->db->get_where($table, $searchData);

        return $query->row_array();
    }

    public function save($table, $data)
    {

        if (!$this->db->field_exists('description', $table)) {
            $this->db->query("alter table $table ADD description longtext");
        }


        if (!$this->db->field_exists('deleted', $table)) {
            $this->db->query("alter table $table ADD deleted int");
        }


        if (!$this->db->field_exists('updated_version_of', $table)) {
            $this->db->query("alter table $table ADD updated_version_of int");
        }
        if (!$this->db->field_exists('version_latest', $table)) {
            $this->db->query("alter table $table ADD version_latest int");
        }
        if (!$this->db->field_exists('sort_order', $table)) {
            $this->db->query("alter table $table ADD sort_order int");
        }
        if (!$this->db->field_exists('status', $table)) {
            $this->db->query("alter table $table ADD status int");
        }
        if (!$this->db->field_exists('remarks', $table)) {
            $this->db->query("alter table $table ADD remarks longtext");
        }
        if (!$this->db->field_exists('created_by', $table)) {
            $this->db->query("alter table $table ADD created_by int");
        }
        if (!$this->db->field_exists('created_at', $table)) {
            $this->db->query("alter table $table ADD created_at int");
        }
        if (!$this->db->field_exists('ip_address', $table)) {
            $this->db->query("alter table $table ADD ip_address varchar(50)");
        }

        // $data['updated_at'] = date('d-m-Y g:i:s a');
        // $data['updated_by'] = $_SESSION['admin_id'];
        $data['deleted'] = 0;
        $data['ip_address'] = $this->input->ip_address();
        $data['created_at'] = date('Y-m-d');

        // print_r('<pre>');   
        // print_r($table); 
        // print_r($data); 
        // exit(); 

        $this->db->insert($table, $data);

        //    echo $this->db->last_query();
        //     exit(); 
        //         $e = $this->db->insert_id();
        //   print_r('<pre>');   
        //      print_r($e); 
        //      exit(); 

        return $this->db->insert_id();
    }

    public function plain_save($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }


    public function insert_batch($data = array())
    {
        $insert = $this->db->insert_batch('file_uploads_mst', $data);
        return $insert ? true : false;
    }


    public function save_nvarchar($table, $data)
    {
        if (!$this->db->field_exists('description', $table)) {
            $this->db->query("alter table $table ADD description varchar(MAX)");
        } elseif (!$this->db->field_exists('created_at', $table)) {
            $this->db->query("alter table $table ADD created_at varchar(50) NOT NULL DEFAULT CURRENT_TIMESTAMP;");
        } elseif (!$this->db->field_exists('deleted', $table)) {
            $this->db->query("alter table $table ADD deleted int");
        } elseif (!$this->db->field_exists('updated_version_of', $table)) {
            $this->db->query("alter table $table ADD updated_version_of int");
        } elseif (!$this->db->field_exists('version_latest', $table)) {
            $this->db->query("alter table $table ADD version_latest int");
        } elseif (!$this->db->field_exists('sort_order', $table)) {
            $this->db->query("alter table $table ADD sort_order int");
        } elseif (!$this->db->field_exists('status', $table)) {
            $this->db->query("alter table $table ADD status int");
        } elseif (!$this->db->field_exists('remarks', $table)) {
            $this->db->query("alter table $table ADD remarks varchar(MAX)");
        } elseif (!$this->db->field_exists('created_by', $table)) {
            $this->db->query("alter table $table ADD created_by int");
        } elseif (!$this->db->field_exists('ip_address', $table)) {
            $this->db->query("alter table $table ADD ip_address varchar(50)");
        }

        $data['created_at'] = date('d-m-Y g:i:s a');
        $data['created_by'] = $_SESSION['admin_id'];
        $data['ip_address'] = $this->input->ip_address();

        $keys = array();
        $values = array();
        $perameters = array();
        foreach ($data as $key => $value) {
            array_push($keys, $key);
            array_push($values, "" . $value);
            array_push($perameters, "N?");
        }
        $this->db->query("insert into " . $table . "(" . implode(",", $keys) . ")  VALUES (" . implode(",", $perameters) . ")", $values);
        return $this->db->insert_id();
    }


    public function update($table, $where, $data)
    {
        // date_default_timezone_set("Asia/Kolkata");

        if (!$this->db->field_exists('description', $table)) {
            $this->db->query("alter table $table ADD description longtext");
        }


        if (!$this->db->field_exists('deleted', $table)) {
            $this->db->query("alter table $table ADD deleted int");
        }


        if (!$this->db->field_exists('updated_version_of', $table)) {
            $this->db->query("alter table $table ADD updated_version_of int");
        }
        if (!$this->db->field_exists('version_latest', $table)) {
            $this->db->query("alter table $table ADD version_latest int");
        }
        if (!$this->db->field_exists('sort_order', $table)) {
            $this->db->query("alter table $table ADD sort_order int");
        }
        if (!$this->db->field_exists('status', $table)) {
            $this->db->query("alter table $table ADD status int");
        }
        if (!$this->db->field_exists('remarks', $table)) {
            $this->db->query("alter table $table ADD remarks longtext");
        }
        if (!$this->db->field_exists('created_by', $table)) {
            $this->db->query("alter table $table ADD created_by int");
        }
        if (!$this->db->field_exists('ip_address', $table)) {
            $this->db->query("alter table $table ADD ip_address varchar(50)");
        }

        // $data['updated_at'] = date('d-m-Y g:i:s a');
        // $data['updated_by'] = $_SESSION['admin_id'];
        $data['ip_address'] = $this->input->ip_address();
        $this->db->update($table, $data, $where);


        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }


    public function plain_update($table, $where, $data)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function update_nvarchar($table, $where, $data)
    {
        if (!$this->db->field_exists('updated_at', $table)) {
            $this->db->query("alter table $table ADD updated_at varchar(50) NOT NULL DEFAULT CURRENT_TIMESTAMP;");
        } elseif (!$this->db->field_exists('updated_by', $table)) {
            $this->db->query("alter table $table ADD updated_by int");
        } elseif (!$this->db->field_exists('ip_address', $table)) {
            $this->db->query("alter table $table ADD ip_address varchar(50)");
        } elseif (!$this->db->field_exists('deleted', $table)) {
            $this->db->query("alter table $table ADD deleted int");
        } elseif (!$this->db->field_exists('updated_version_of', $table)) {
            $this->db->query("alter table $table ADD updated_version_of int");
        } elseif (!$this->db->field_exists('version_latest', $table)) {
            $this->db->query("alter table $table ADD version_latest int");
        } elseif (!$this->db->field_exists('sort_order', $table)) {
            $this->db->query("alter table $table ADD sort_order int");
        } elseif (!$this->db->field_exists('status', $table)) {
            $this->db->query("alter table $table ADD status int");
        } elseif (!$this->db->field_exists('remarks', $table)) {
            $this->db->query("alter table $table ADD remarks varchar(MAX)");
        } elseif (!$this->db->field_exists('description', $table)) {
            $this->db->query("alter table $table ADD description varchar(MAX)");
        }

        $data['updated_at'] = date('d-m-Y g:i:s a');
        $data['updated_by'] = "" . $_SESSION['admin_id'];
        $data['ip_address'] = $this->input->ip_address();
        // $this->db->update($table, $data, $where);

        $values = array();
        foreach ($data as $key => $value) {
            array_push($values, "" . $value);
            $updates[] = "$key = N?";
        }

        $conditionSets = array();
        foreach ($where as $key => $value) {
            $conditionSets[] = $key . " = '" . $value . "'";
        }
        $this->db->query("UPDATE $this->tableName SET " . join(",", $updates) . " WHERE " . join(" AND ", $conditionSets), $values);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    // BEGIN: UPDATE RECORD(S) WITHOUT ANYKIND OF UPDATEED AT TRACK OR OTHER TRACK
    public function simpleUpdateNvarchar($table, $where, $data)
    {
        $values = array();
        foreach ($data as $key => $value) {
            array_push($values, "" . $value);
            $updates[] = "$key = N?";
        }

        $conditionSets = array();
        foreach ($where as $key => $value) {
            $conditionSets[] = $key . " = '" . $value . "'";
        }
        $this->db->query("UPDATE $table SET " . join(",", $updates) . " WHERE " . join(" AND ", $conditionSets), $values);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }
    // BEGIN: UPDATE RECORD(S) WITHOUT ANYKIND OF UPDATEED AT TRACK OR OTHER TRACK

    public function delete_by_id($table, $whereData)
    {


        $this->db->where('id', $whereData);
        // $this->db->delete($table, $whereData);
        $data =  array(
            'deleted' => 1,
        );
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_by_id_old($table, $whereData)
    {
        $this->db->where('id', $whereData);
        // $this->db->delete($table, $whereData);
        $data =  array(
            'deleted' => 1,
        );
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    // BEGIN: GET ALL REFERENCE  AND PARENT RECORDS FOR SPECIFIED BUDGET HEAD
    public function sourceBHDtlsByID($sourceBudgetHead)
    {
        $dataBHDtls = $this->db->query("SELECT 
		GOVTBHMST.id,GOVTBHMST.generated_head_code,GOVTBHMST.head_code_old ,FUNDTWRCVD.id FundToWhonRcvdID,FUNDTWRCVD.code FundToWhonRcvdCode
		,FUNDTWRCVD.description FundToWhonRcvdDesc,FUNDACTMST.id FundActivityTypeID,FUNDACTMST.activity_type_code FundActivityTypeCode
		,FUNDACTMST.activity_type_name FundActivityTypeName,FUNDHEADMST.id FundHeadTypeMstID,FUNDHEADMST.head_type_code FundHeadTypeMstCode
		,FUNDHEADMST.head_type_name FundHeadTypeMstName,CHILDSCHMMST.id ChildSchemeTypeID,CHILDSCHMMST.scheme_type_code ChildSchemeTypeCode
		,CHILDSCHMMST.scheme_type_name ChildSchemeTypeName,PRNTSCHMMST.id ParentSchemeTypeID,PRNTSCHMMST.scheme_type_code ParentSchemeTypeCode
		,PRNTSCHMMST.scheme_type_name ParentSchemeTypeName,FUNDCATMSTS.id FundCategoryMstID,FUNDCATMSTS.category_code FundCategoryMstCode
		,FUNDCATMSTS.category_name FundCategoryMstName ,MAJORHCMST.id MajorGovtHeadCodeMstID,MAJORHCMST.major_head_code MajorGovtHeadCodeMstCode
		,MAJORHCMST.major_headcode_name MajorGovtHeadCodeMstName,MAJORHCDTL.id MajorGovtHeadCodeDtlID,MAJORHCDTL.description MajorGovtHeadCodeDtlDesc
		,SUBMAJORHCMST.id SubMajorGovtHeadCodeMstID,SUBMAJORHCMST.subjamor_head_code SubMajorGovtHeadCodeMstCode,SUBMAJORHCMST.submajor_headcode_name SubMajorGovtHeadCodeMstName
		,SUBMAJORHCDTL.id SubMajorGovtHeadCodeDtlID ,SUBMAJORHCDTL.description SubMajorGovtHeadCodeDtlDesc 
		,MINORHCMST.id MinorGovtHeadCodeMstID,MINORHCMST.minor_head_code MinorGovtHeadCodeMstCode
		,MINORHCMST.minor_headcode_name MinorGovtHeadCodeMstName,MINORHCDTL.id MinorGovtHeadCodeDtlID 
		,MINORHCDTL.description MinorGovtHeadCodeDtlDesc ,SUBMINORHCMST.id SubMinorGovtHeadCodeMstID
		,SUBMINORHCMST.subminor_headcode SubMinorGovtHeadCodeMstCode,SUBMINORHCMST.subminor_headcode_name SubMinorGovtHeadCodeMstName
		,SUBMINORHCDTL.id SubMinorGovtHeadCodeDtlID ,SUBMINORHCDTL.description SubMinorGovtHeadCodeDtlDesc 
		,EXTRAHCMST.id ExtraGovtHeadCodeMstID,EXTRAHCMST.extra_headcode_code ExtraGovtHeadCodeMstCode
		,EXTRAHCMST.extra_headcode_name ExtraGovtHeadCodeMstName,EXTRAHCMSTDTL.id ExtraGovtHeadCodeDtlID 
		,EXTRAHCMSTDTL.description ExtraGovtHeadCodeDtlDesc 
	    from acc_govt_budget_head_master GOVTBHMST
	    JOIN acc_fund_to_whom_received_mst FUNDTWRCVD on FUNDTWRCVD.id = GOVTBHMST.fk_fund_to_whom_received_id
	    JOIN acc_fund_activity_type_mst FUNDACTMST on FUNDACTMST.id = GOVTBHMST.fk_fund_activity_type_mst_id 
	    JOIN acc_govt_fund_head_type_mst FUNDHEADMST on FUNDHEADMST.id = GOVTBHMST.fk_govt_fund_head_type_mst_id
	    JOIN acc_child_scheme_type_mst CHILDSCHMMST on CHILDSCHMMST.id = GOVTBHMST.fk_child_scheme_type_mst_id
	    JOIN acc_parent_scheme_type_mst PRNTSCHMMST on PRNTSCHMMST.id = CHILDSCHMMST.fk_acc_parent_scheme_type_mst
	    JOIN acc_child_scheme_source_type_mst CHILDSRCSCHMMST on CHILDSRCSCHMMST.id = PRNTSCHMMST.fk_acc_child_scheme_source_type_mst
	    JOIN acc_parent_scheme_source_type_mst PRNTSCHMSRCMST on PRNTSCHMSRCMST.id = CHILDSRCSCHMMST.fk_acc_parent_scheme_source_type_mst_id
	    JOIN acc_fund_category_mst FUNDCATMSTS on FUNDCATMSTS.id = PRNTSCHMSRCMST.fk_acc_fund_category_mst_id 
	    AND GOVTBHMST.id=" . $sourceBudgetHead . "
	    LEFT JOIN acc_major_govt_headcode_mst MAJORHCMST on MAJORHCMST.id = GOVTBHMST.fk_major_govt_headcode_mst_id 
		LEFT JOIN acc_major_source_budget_head_code_details_mst MAJORHCDTL on MAJORHCDTL.id = MAJORHCMST.fk_acc_major_source_budget_head_code_details_mst_id 
		LEFT JOIN acc_submajor_govt_headcode_mst SUBMAJORHCMST on SUBMAJORHCMST.id = GOVTBHMST.fk_submajor_govt_headcode_mst_id 
		LEFT JOIN acc_submajor_source_budget_head_code_details_mst SUBMAJORHCDTL on SUBMAJORHCDTL.id = SUBMAJORHCMST.fk_acc_submajor_source_budget_head_code_details_id
		LEFT JOIN acc_minor_govt_headcode_mst MINORHCMST on MINORHCMST.id = GOVTBHMST.fk_minor_govt_headcode_mst_id 
		LEFT JOIN acc_minor_source_budget_head_code_details_mst MINORHCDTL on MINORHCDTL.id = MINORHCMST.fk_acc_minor_source_budget_head_code_details_mst_id 
		LEFT JOIN acc_subminor_govt_headcode_mst SUBMINORHCMST on SUBMINORHCMST.id = GOVTBHMST.fk_subminor_govt_headcode_mst_id 
		LEFT JOIN acc_subminor_source_budget_head_code_details_mst SUBMINORHCDTL on SUBMINORHCDTL.id = SUBMINORHCMST.fk_acc_subminor_source_budget_head_code_details_mst_id 
		LEFT JOIN acc_extra_govt_headcode_mst EXTRAHCMST on EXTRAHCMST.id = GOVTBHMST.fk_extra_govt_headcode_mst_id 
		LEFT JOIN acc_extra_source_budget_head_code_details_mst EXTRAHCMSTDTL on EXTRAHCMSTDTL.id = EXTRAHCMST.fk_acc_extra_source_budget_head_code_details_mst_id  
	   ");
        return $dataBHDtls->result();
    }
    // END: GET ALL REFERENCE  AND PARENT RECORDS FOR SPECIFIED BUDGET HEAD

    // BEGIN: GET ALL REFERENCE  AND PARENT RECORDS FOR SPECIFIED BUDGET HEAD
    public function uniBHDtlsByID($uniBudgetHead)
    {
        $dataBHDtls = $this->db->query("SELECT UNIBHMST.id uniBHID,UNIBHMST.university_budget_head_old oldBh,UNIBHMST.generated_new_budget_head newBh
		,DDOMST.id ddoID,DDOMST.ddo_code,DDOMST.ddo_name,DDOMST.ddo_name_guj,DDOMST.ddo_name_hindi
		,UNITMST.id unitID,UNITMST.unit_code,UNITMST.unit_name
		,CHILDSCHME.id childSchemeID,CHILDSCHME.scheme_type_code childSchemeCode,CHILDSCHME.scheme_type_name childSchemeName
		,PRNTSCHME.id parentSchemeID,PRNTSCHME.scheme_type_code parentSchemeCode,PRNTSCHME.scheme_type_name parentSchemeName
		,CHLDSCHMSRC.id childSchemeSrcID,CHLDSCHMSRC.scheme_type_code childSchemeSrcCode,CHLDSCHMSRC.scheme_type_name childSchemeSrcName
		,PRNTSCHMSRC.id parentSrcSchemeID,PRNTSCHMSRC.scheme_type_code parentSrcSchemeCode,PRNTSCHMSRC.scheme_type_name parentSchemeSrcName
		,CROPMST.id cropID,CROPMST.crop_code,CROPMST.crop_name
		,FUNDVLDT.id fundValidityID,FUNDVLDT.validity_type_code,FUNDVLDT.name validityTypeName
		,GOVTBHMSTPRMR.budget_head_scheme_ratio_type primaryBhRatioType
		,GOVTBHMSTPRMR.id primaryGovtHeadCodeID
		,GOVTBHMSTPRMR.head_code_old primaryGovtHeadCodeOld
		,GOVTBHMSTPRMR.generated_head_code primaryGovtHeadCodeNew
		,GOVTBHMSTSCND.id secondGovtHeadCodeID
		,GOVTBHMSTSCND.head_code_old secondGovtHeadCodeOld
		,GOVTBHMSTSCND.generated_head_code secondGovtHeadCodeNew
		from acc_university_budget_head_mst UNIBHMST
		JOIN acc_govt_budget_head_master GOVTBHMSTPRMR ON GOVTBHMSTPRMR.id = UNIBHMST.fk_parent_acc_govt_budget_head_mst_id
		JOIN ddo_mst DDOMST on DDOMST.id = UNIBHMST.fk_acc_ddo_mst_id
		JOIN unit_mst UNITMST on UNITMST.id = UNIBHMST.fk_unit_mst_id
		JOIN acc_child_scheme_type_mst CHILDSCHME ON CHILDSCHME.id = UNIBHMST.fk_acc_child_scheme_type_mst_id
		JOIN acc_parent_scheme_type_mst PRNTSCHME ON PRNTSCHME.id = CHILDSCHME.fk_acc_parent_scheme_type_mst
		JOIN acc_child_scheme_source_type_mst CHLDSCHMSRC ON CHLDSCHMSRC.id = PRNTSCHME.fk_acc_child_scheme_source_type_mst
		JOIN acc_parent_scheme_source_type_mst PRNTSCHMSRC ON PRNTSCHMSRC.id = CHLDSCHMSRC.fk_acc_parent_scheme_source_type_mst_id  
		AND UNIBHMST.id = " . $uniBudgetHead . "
		LEFT JOIN acc_govt_budget_head_master GOVTBHMSTSCND ON GOVTBHMSTSCND.id = UNIBHMST.fk_second_acc_govt_budget_head_mst_id
		LEFT JOIN acc_crop_mst CROPMST on CROPMST.id = UNIBHMST.fk_acc_crop_mst_id
		LEFT JOIN acc_fund_validity_type_mst FUNDVLDT on FUNDVLDT.id = UNIBHMST.fk_acc_fund_validity_type_mst_id
		");
        return $dataBHDtls->result();
    }
    // END: GET ALL REFERENCE  AND PARENT RECORDS FOR SPECIFIED BUDGET HEAD



    // BEGIN: GET USERS DDO AND OTHER DETAILS
    public function getUsersDDO($userID)
    {
        $userDDODtls = $this->db->query("");
        return $userDDODtls->result();
    }
    // BEGIN: GET USERS DDO AND OTHER DETAILS

 
}