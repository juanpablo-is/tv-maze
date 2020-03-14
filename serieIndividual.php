<?php

class Serie
{

    private $title;
    private $star;
    private $image;
    private $id;
    private $language;
    private $summary;
    private $type;
    private $genres;
    private $status;
    private $schedule;

    public function __construct($title, $star, $image, $id)
    {
        $this->title = $title;
        $this->id = $id;
        $this->image = $image;
        $this->star = $star;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStar()
    {
        return $this->star;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getGenres()
    {
        return $this->genres;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
