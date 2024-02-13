<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'day_create',
            ],
            [
                'id'    => 18,
                'title' => 'day_edit',
            ],
            [
                'id'    => 19,
                'title' => 'day_show',
            ],
            [
                'id'    => 20,
                'title' => 'day_delete',
            ],
            [
                'id'    => 21,
                'title' => 'day_access',
            ],
            [
                'id'    => 22,
                'title' => 'month_create',
            ],
            [
                'id'    => 23,
                'title' => 'month_edit',
            ],
            [
                'id'    => 24,
                'title' => 'month_show',
            ],
            [
                'id'    => 25,
                'title' => 'month_delete',
            ],
            [
                'id'    => 26,
                'title' => 'month_access',
            ],
            [
                'id'    => 27,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 29,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 30,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 31,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 32,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 33,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 34,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 35,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 36,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 37,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 38,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 39,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 40,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 41,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 42,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 43,
                'title' => 'bhagavathgeetha_create',
            ],
            [
                'id'    => 44,
                'title' => 'bhagavathgeetha_edit',
            ],
            [
                'id'    => 45,
                'title' => 'bhagavathgeetha_show',
            ],
            [
                'id'    => 46,
                'title' => 'bhagavathgeetha_delete',
            ],
            [
                'id'    => 47,
                'title' => 'bhagavathgeetha_access',
            ],
            [
                'id'    => 48,
                'title' => 'bhakthigeetam_create',
            ],
            [
                'id'    => 49,
                'title' => 'bhakthigeetam_edit',
            ],
            [
                'id'    => 50,
                'title' => 'bhakthigeetam_show',
            ],
            [
                'id'    => 51,
                'title' => 'bhakthigeetam_delete',
            ],
            [
                'id'    => 52,
                'title' => 'bhakthigeetam_access',
            ],
            [
                'id'    => 53,
                'title' => 'kathalu_create',
            ],
            [
                'id'    => 54,
                'title' => 'kathalu_edit',
            ],
            [
                'id'    => 55,
                'title' => 'kathalu_show',
            ],
            [
                'id'    => 56,
                'title' => 'kathalu_delete',
            ],
            [
                'id'    => 57,
                'title' => 'kathalu_access',
            ],
            [
                'id'    => 58,
                'title' => 'pujalu_create',
            ],
            [
                'id'    => 59,
                'title' => 'pujalu_edit',
            ],
            [
                'id'    => 60,
                'title' => 'pujalu_show',
            ],
            [
                'id'    => 61,
                'title' => 'pujalu_delete',
            ],
            [
                'id'    => 62,
                'title' => 'pujalu_access',
            ],
            [
                'id'    => 63,
                'title' => 'puranalu_create',
            ],
            [
                'id'    => 64,
                'title' => 'puranalu_edit',
            ],
            [
                'id'    => 65,
                'title' => 'puranalu_show',
            ],
            [
                'id'    => 66,
                'title' => 'puranalu_delete',
            ],
            [
                'id'    => 67,
                'title' => 'puranalu_access',
            ],
            [
                'id'    => 68,
                'title' => 'vrathalu_create',
            ],
            [
                'id'    => 69,
                'title' => 'vrathalu_edit',
            ],
            [
                'id'    => 70,
                'title' => 'vrathalu_show',
            ],
            [
                'id'    => 71,
                'title' => 'vrathalu_delete',
            ],
            [
                'id'    => 72,
                'title' => 'vrathalu_access',
            ],
            [
                'id'    => 73,
                'title' => 'service_access',
            ],
            [
                'id'    => 74,
                'title' => 'puja_booking_create',
            ],
            [
                'id'    => 75,
                'title' => 'puja_booking_delete',
            ],
            [
                'id'    => 76,
                'title' => 'puja_booking_access',
            ],
            [
                'id'    => 77,
                'title' => 'muhurthambooking_create',
            ],
            [
                'id'    => 78,
                'title' => 'muhurthambooking_delete',
            ],
            [
                'id'    => 79,
                'title' => 'muhurthambooking_access',
            ],
            [
                'id'    => 80,
                'title' => 'horoscopedetail_create',
            ],
            [
                'id'    => 81,
                'title' => 'horoscopedetail_delete',
            ],
            [
                'id'    => 82,
                'title' => 'horoscopedetail_access',
            ],
            [
                'id'    => 83,
                'title' => 'onlinepujadetail_create',
            ],
            [
                'id'    => 84,
                'title' => 'onlinepujadetail_delete',
            ],
            [
                'id'    => 85,
                'title' => 'onlinepujadetail_access',
            ],
            [
                'id'    => 86,
                'title' => 'vedas_detail_create',
            ],
            [
                'id'    => 87,
                'title' => 'vedas_detail_delete',
            ],
            [
                'id'    => 88,
                'title' => 'vedas_detail_access',
            ],
            [
                'id'    => 89,
                'title' => 'donation_detail_create',
            ],
            [
                'id'    => 90,
                'title' => 'donation_detail_delete',
            ],
            [
                'id'    => 91,
                'title' => 'donation_detail_access',
            ],
            [
                'id'    => 92,
                'title' => 'godanam_detail_create',
            ],
            [
                'id'    => 93,
                'title' => 'godanam_detail_delete',
            ],
            [
                'id'    => 94,
                'title' => 'godanam_detail_access',
            ],
            [
                'id'    => 95,
                'title' => 'seva_detail_create',
            ],
            [
                'id'    => 96,
                'title' => 'seva_detail_delete',
            ],
            [
                'id'    => 97,
                'title' => 'seva_detail_access',
            ],
            [
                'id'    => 98,
                'title' => 'job_portal_access',
            ],
            [
                'id'    => 99,
                'title' => 'job_category_create',
            ],
            [
                'id'    => 100,
                'title' => 'job_category_edit',
            ],
            [
                'id'    => 101,
                'title' => 'job_category_show',
            ],
            [
                'id'    => 102,
                'title' => 'job_category_delete',
            ],
            [
                'id'    => 103,
                'title' => 'job_category_access',
            ],
            [
                'id'    => 104,
                'title' => 'job_role_create',
            ],
            [
                'id'    => 105,
                'title' => 'job_role_edit',
            ],
            [
                'id'    => 106,
                'title' => 'job_role_show',
            ],
            [
                'id'    => 107,
                'title' => 'job_role_delete',
            ],
            [
                'id'    => 108,
                'title' => 'job_role_access',
            ],
            [
                'id'    => 109,
                'title' => 'job_creation_create',
            ],
            [
                'id'    => 110,
                'title' => 'job_creation_edit',
            ],
            [
                'id'    => 111,
                'title' => 'job_creation_show',
            ],
            [
                'id'    => 112,
                'title' => 'job_creation_delete',
            ],
            [
                'id'    => 113,
                'title' => 'job_creation_access',
            ],
            [
                'id'    => 114,
                'title' => 'job_application_create',
            ],
            [
                'id'    => 115,
                'title' => 'job_application_delete',
            ],
            [
                'id'    => 116,
                'title' => 'job_application_access',
            ],
            [
                'id'    => 117,
                'title' => 'month_mi_create',
            ],
            [
                'id'    => 118,
                'title' => 'month_mi_edit',
            ],
            [
                'id'    => 119,
                'title' => 'month_mi_show',
            ],
            [
                'id'    => 120,
                'title' => 'month_mi_delete',
            ],
            [
                'id'    => 121,
                'title' => 'month_mi_access',
            ],
            [
                'id'    => 122,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 123,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 124,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 125,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 126,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 127,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 128,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 129,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 130,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 131,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 132,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 133,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 134,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 135,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 136,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 137,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 138,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 139,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 140,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 141,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 142,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 143,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
