<?php

namespace PropeBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Registro
 *
 * @ORM\Table(name="registro")
 * @ORM\Entity(repositoryClass="PropeBundle\Repository\RegistroRepository")
 * @Vich\Uploadable
 */
class Registro
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="nombre", type="string", length=80)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="apellidos", type="string", length=80)
     */
    private $apellidos;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es válido.",
     *     checkMX = true
     * )
     * @ORM\Column(name="correo", type="string", length=120)
     */
    private $correo;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="ciudad", type="string", length=120)
     */
    private $ciudad;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="institucion", type="string", length=140)
     */
    private $institucion;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="estado", type="string", length=120)
     */
    private $estado;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="curso", type="string", length=150)
     */
    private $curso;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="intencion", type="text")
     */
    private $intencion;

    /**
     * @var string
     *
     * @ORM\Column(name="beca", type="string", length=150)
     */
    private $beca;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifiedAt", type="datetime")
     */
    private $modifiedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmado", type="boolean", nullable=true)
     */
    private $confirmado;

    /**
     * @var bool
     *
     * @ORM\Column(name="concedido", type="boolean", nullable=true)
     */
    private $concedido;

    /**
     * @Gedmo\Slug(fields={"nombre", "apellidos"})
     * @ORM\Column(length=64, unique=true)
     */
    private $slug;

    /**
     * @Assert\File(
     *  maxSize = "4M",
     *  mimeTypes = {"application/pdf", "application/x-pdf"},
     *  mimeTypesMessage = "El formato del archivo debe ser PDF y de tamaño menor a 4M"
     * )
     * @Vich\UploadableField(mapping="solicitud_kardex", fileNameProperty="kardexName")
     *
     * @var File
     */
    private $kardexFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $kardexName;

    /**
     * @Assert\File(
     *  maxSize = "4M",
     *  mimeTypes = {"application/pdf", "application/x-pdf"},
     *  mimeTypesMessage = "El formato del archivo debe ser PDF y de tamaño menor a 4M"
     * )
     * @Vich\UploadableField(mapping="solicitud_recomendacion", fileNameProperty="recomendacionName")
     *
     * @var File
     */
    private $recomendacionFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $recomendacionName;

    /**
     * @var string
     * @ORM\Column(name="notas", type="text", nullable=true)
     */
    private $notas;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Registro
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Registro
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     * @return Registro
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Registro
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Registro
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Registro
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set curso
     *
     * @param string $curso
     * @return Registro
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return string 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set intencion
     *
     * @param string $intencion
     * @return Registro
     */
    public function setIntencion($intencion)
    {
        $this->intencion = $intencion;

        return $this;
    }

    /**
     * Get intencion
     *
     * @return string 
     */
    public function getIntencion()
    {
        return $this->intencion;
    }

    /**
     * Set beca
     *
     * @param boolean $beca
     * @return Registro
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;

        return $this;
    }

    /**
     * Get beca
     *
     * @return boolean 
     */
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Registro
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return Registro
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set confirmado
     *
     * @param boolean $confirmado
     * @return Registro
     */
    public function setConfirmado($confirmado)
    {
        $this->confirmado = $confirmado;

        return $this;
    }

    /**
     * Get confirmado
     *
     * @return boolean 
     */
    public function getConfirmado()
    {
        return $this->confirmado;
    }

    /**
     * Set concedido
     *
     * @param boolean $concedido
     * @return Registro
     */
    public function setConcedido($concedido)
    {
        $this->concedido = $concedido;

        return $this;
    }

    /**
     * Get concedido
     *
     * @return boolean 
     */
    public function getConcedido()
    {
        return $this->concedido;
    }

    public function getSlug()
    {
        return $this->slug;
    }

   /**
    * Métodos para fileupload
    */

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $kardex
     *
     * @return Registro
     */
    public function setKardexFile(File $kardex = null)
    {
        $this->kardexFile = $kardex;

        if ($kardex) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->modifiedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getKardexFile()
    {
        return $this->kardexFile;
    }

    /**
     * @param string $kardexName
     *
     * @return Registro
     */
    public function setKardexName($kardexName)
    {
        $this->kardexName = $kardexName;

        return $this;
    }

    /**
     * @return string
     */
    public function getKardexName()
    {
        return $this->kardexName;
    }

    /**
     * Recomendación
     */


    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $recomendacion
     *
     * @return Registro
     */
    public function setRecomendacionFile(File $recomendacion = null)
    {
        $this->recomendacionFile = $recomendacion;

        if ($recomendacion) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->modifiedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getRecomendacionFile()
    {
        return $this->recomendacionFile;
    }

    /**
     * @param string $recomendacionName
     *
     * @return Registro
     */
    public function setRecomendacionName($recomendacionName)
    {
        $this->recomendacionName = $recomendacionName;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecomendacionName()
    {
        return $this->recomendacionName;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Registro
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * Get notas
     *
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }
}
