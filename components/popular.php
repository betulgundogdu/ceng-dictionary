  
    <div class="popular">
        <?php
            $popular = $dbActions->getPopularHeaders();
            while($row = $popular->fetch_assoc()){
                $h_id = $row['h_id'];
                $header = $dbActions->getHeaderWithId($h_id);
                $header_info = $header->fetch_assoc();
                $h_title = $header_info['title'];
                $c_id = $header_info['c_id'];
                $last_entry = $dbActions->getLastEntry($h_id);
                $last_entry_info = $last_entry->fetch_assoc();
                $entry_user = $dbActions->getUserWithId($last_entry_info['u_id']);
                $entry_user_info = $entry_user->fetch_assoc();
                $entry_username = $entry_user_info['username'];
                echo '
                <div class="entry">
                    <a href="?page=entry&category=' . $c_id . '&baslik='. $h_id .'"> ' . $header_info['title'] . ' </a>
                    <p class="entry-text"> ' . $last_entry_info['text'] . '</p>
                    <div class="right detail">
                        <a class="username" href="?page=profil&user=' . $entry_user_info . '">'. $entry_username . '</a>
                        <span class="time"> ' . $last_entry_info['created_date'] . '</span>
                    </div>
                </div>
                ';
            }
        ?>

    </div>
