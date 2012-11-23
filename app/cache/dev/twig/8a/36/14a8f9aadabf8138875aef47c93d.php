<?php

/* AcmeBlogBundle:Security:login.html.twig */
class __TwigTemplate_8a3614a8f9aadabf8138875aef47c93d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        $this->displayBlock('title', $context, $blocks);
        // line 7
        echo " 
";
        // line 8
        $this->displayBlock('content', $context, $blocks);
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "    symfony2 Учебник | Войти
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if ($this->getContext($context, "error")) {
            // line 10
            echo "        <div class=\"error\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "error"), "message"), "html", null, true);
            echo "</div>
    ";
        }
        // line 12
        echo " 
    <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_security_check"), "html", null, true);
        echo "\" method=\"POST\">
        <table>
            <tr>
                <td>
                    <label for=\"username\">Логин:</label>
                </td>
                <td>
                    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getContext($context, "last_username"), "html", null, true);
        echo "\" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for=\"password\">Пароль:</label>
                </td>
                <td>
                    <input type=\"password\" id=\"password\" name=\"_password\" />
                </td>
            </tr>
        </table>
        <input type=\"submit\" name=\"login\" value=\"Отправить\" />
    </form>
";
    }

    public function getTemplateName()
    {
        return "AcmeBlogBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 20,  63 => 13,  60 => 12,  54 => 10,  51 => 9,  48 => 8,  43 => 5,  40 => 4,  36 => 8,  33 => 7,  31 => 4,  28 => 3,);
    }
}
