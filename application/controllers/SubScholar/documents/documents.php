<?php

class documentsSub {
    public function documentsController($self) {
        $content = "";
        $title = "";

        switch ((!empty($_GET['view'])) ? $_GET['view'] : null) {
       
            default:

            $mydb = $self->db->query("SELECT * 
            FROM  `upload_documents`");
$cur = $mydb->result();

            $content = $self->load->view(
                              'Scholar/theme/modules/document/list',
                              array(
                                  "cur" => $cur
                              ),
                              true
                          );
                          break;
                  }
                  $self->load->view(
                    'resource',
                    array(
                        'body' =>  $self->load->view(
                            "Scholar/theme/template",
                            array(
                                "content" =>  $content,
                                "cur" => $self->countNotif($_SESSION['USERID']),
                                "title" => "Announcement"
                            ),
                            true
                        ),
                        "title" => $title
                    )
                );
    }
}