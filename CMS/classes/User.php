<?php
/*
 * Class User
 * id, userType, username, email, pass dateAdded
 *
 * getId()
 * isAdmin()
 * canEditPage()
 * canCreatePage()
 */
class User
{
    protected $id = null;
    protected $userType = null;
    protected $username = null;
    protected $email = null;
    protected $pass = null;
    protected $dateAdded = null;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }
    function isAdmin() {
        return ($this->userType == 'admin');
    }
    // Return if person is admin or created page
    function canEditPage(Page $p) {
        return ($this->isAdmin() || ($this->id == $p->getCreatorID()));
    }
    // return if user is an admin or author
    function canCreatePage() {
        return ($this->isAdmin() || ($this->userType == 'author'));
    }

}