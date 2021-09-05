<?php

namespace App\Commands;

use Symfony\Component\Console\Output\OutputInterface;
use Spatie\PdfToText\Pdf;

class PdfGeneratorCommand
{
    # `where pdftotexe` 
    private const EXE = 'C:\Program Files\Git\mingw64\bin\pdftotext.exe';

    private const FILE = 'public/pdf-to-text/text-file.md';

    public function __invoke(OutputInterface $output)
    {
        $pdfRepo = getcwd() . "/public/pdf/";
        $pdfPath = $pdfRepo . 'sample.pdf';

        $content = (new Pdf(self::EXE))
            ->setPdf($pdfPath)
            ->setOptions(
                [
                    'table',
                    'bom',
                    'enc UTF-8',
                ]
            )
            ->text()
        ;
        
        $formater = "<pre>" . $content . "</pre>";
        file_put_contents(self::FILE, $formater);
        $output->writeln('PDF ok !'); 
    }
}
